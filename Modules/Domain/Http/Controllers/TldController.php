<?php

namespace Modules\Domain\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Domain\Entities\Tld;
use Modules\Domain\Http\Requests\TldOtherRequest;
use Modules\Domain\Http\Requests\TldRequest;
use Modules\OpenSRS\API\ProcessRequest;
use Modules\Domain\Entities\Continent;
use Modules\Domain\Entities\TldGroup;
use Modules\Domain\Entities\CategoryTld;
use Modules\Domain\Entities\TldsPrices;
use Modules\Domain\Entities\TldsRenewalPrices;
use Modules\GEO\Entities\Country;
use Illuminate\Support\Facades\DB;
use Modules\Domain\API\ApiCall;
use App\restricted_countries_tld;
use Modules\Domain\Entities\TldsFeaturesServices;


class TldController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tld_data = array();
        $tlds = Tld::all()->sortBy('sequence');
        $tlds_prices_json = DB::table('tlds_prices')->get();
        $tlds_renewal_prices_json = DB::table('tlds_renewal_prices')->get();
        $tlds_prices_array = json_decode(json_encode($tlds_prices_json), true);
        $tlds_renewal_prices_array = json_decode(json_encode($tlds_renewal_prices_json), true);

        $tld_data['all_tlds'] = $tlds;
        $tld_data['tlds_prices'] = $tlds_prices_array;
        $tld_data['least_promo_prices'] = array();
        $tld_data['least_regular_price'] = array();
        $tld_data['least_renewal_prices'] = array();
        $tld_data['least_bulk_price'] = array();
        $tld_data['least_price_promo_from'] = array();
        $tld_data['least_price_promo_to'] = array();
        foreach ($tld_data['tlds_prices'] as $item) {
            $item_tld = $item['tld_id'];
            $tld_data['least_promo_prices'][$item['tld_id']] = $this->search_least_value_based_on_tld($item['tld_id'], $tld_data['tlds_prices'],'promo_price');
            $tld_data['least_regular_price'][$item['tld_id']] = $this->search_least_value_based_on_tld($item['tld_id'], $tld_data['tlds_prices'],'regular_price');
            $tld_data['least_bulk_price'][$item['tld_id']] = $this->search_least_value_based_on_tld($item['tld_id'], $tld_data['tlds_prices'],'bulk_price');
            $tld_data['least_price_promo_from'][$item['tld_id']] = $tld_data['tlds_prices'][$tld_data['least_promo_prices'][$item_tld][$item_tld ]['id'] - 1]['promo_from'];
            $tld_data['least_price_promo_to'][$item['tld_id']] = $tld_data['tlds_prices'][$tld_data['least_promo_prices'][$item_tld][$item_tld ]['id'] - 1]['promo_to'];
        }
        foreach ($tlds_renewal_prices_array as $item) {
            $tld_data['least_renewal_prices'][$item['tld_id']] = $this->search_least_value_based_on_tld($item['tld_id'], $tlds_renewal_prices_array,'promo_price');
        }
        $tld_data['action_required'] = 0;
        $tld_data['action_required_tlds'] = array();
        foreach ($tlds as $tld) {
            $tld_id = $tld->id;
            $promo_price = 0;
            $regular_price = 0;
            $bulk_price = 0;
            $renewal_prices = 0;
            $cost_price = $tld->cost_price;
            $transfer_price = $tld->transfer_price;
            if(isset($tld_data['least_promo_prices'][$tld_id][$tld_id]['promo_price'])) {
                $promo_price = $tld_data['least_promo_prices'][$tld_id][$tld_id]['promo_price'];
            }
            if(isset($tld_data['least_regular_price'][$tld_id][$tld_id]['regular_price'])) {
                $regular_price = $tld_data['least_regular_price'][$tld_id][$tld_id]['regular_price'];
            }
            if(isset($tld_data['least_bulk_price'][$tld_id][$tld_id]['bulk_price'])) {
                $bulk_price = $tld_data['least_bulk_price'][$tld_id][$tld_id]['bulk_price'];
            }
            if(isset($tld_data['least_renewal_prices'][$tld_id][$tld_id]['promo_price'])) {
                $renewal_prices = $tld_data['least_renewal_prices'][$tld_id][$tld_id]['promo_price'];
            }
            if($promo_price < $cost_price || $regular_price < $cost_price ||
                $bulk_price < $cost_price || $renewal_prices < $cost_price ||
                $transfer_price < $cost_price ) {
                $tld_data['action_required']++;
                $tld_data['action_required_tlds'][] = $tld->id;
            }
        }

        $tld_data['tlds_renewal_prices'] = $tlds_renewal_prices_array;
        $tld_data['total_tlds'] = $tlds->count();
        $tld_data['total_active_tlds'] = $tlds->where('is_active_for_sale', 1)->count();
        $tld_data['OpenSRS_tlds'] = $tlds->whereIn('registrar', array('OpenSRS','Both'))->count();
        $tld_data['Reseller_tlds'] = $tlds->whereIn('registrar', array('ResellerClub','Both'))->count();
        $tld_data['promo_tlds'] = $tlds->whereIn('suggest_group', 'promo')->count();
        $tld_data['bulk__tlds'] = $tlds->whereNotIn('bulk_price_limit', array(0,null))->count();
        $tld_data['last_updated_tld'] = $tlds->sortByDesc('updated_at')->first();
        return view('domain::tlds.view',['tld_data' => $tld_data]);
    }

    public function search_least_value_based_on_tld($id, $array,$find) {
        $ret = array();
        $least_price = 0;
        foreach ($array as $key => $val) {
            if ($val['tld_id'] == $id) {

                if($least_price == 0) {
                    $least_price = $val[$find];
                    $ret[$val['tld_id']][$find]= $least_price;
                    $ret[$val['tld_id']]['id']= $val['id'];
                }
                if($val[$find] <= $least_price ) {
                    $least_price = $val[$find];
                    $ret[$val['tld_id']][$find]= $least_price;
                    $ret[$val['tld_id']]['id']= $val['id'];
                }
            }
        }
        return $ret;
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('domain::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(TldRequest $request)
    {
        $input = Request()::all();
        //to get cost price.
        $domain = 'example'.Request()->name;
        //check the registrar
        if (Request()->registrar == 'OpenSRS')
        {
            //API call for the cost price
            $lookUpArray = [
                'func' => 'GetPrice',
                'attributes' => [
                    'domain' => $domain
                ]
            ];
            $callString = json_encode($lookUpArray);
            $processRequest = new ProcessRequest();
            $openSrsHandler = $processRequest->processData($callString);
            $resultData = $openSrsHandler->resultData;
            try {
                $price = $resultData['attributes']['price'];
                $input['cost_price'] = $price;
            } catch(\Exception $e) {

            }

        }
        try {
            Tld::create($input);
            session()->put('success', 'Tld Stored Successfully');

        } catch (\Exception $e) {
            session()->put('error', 'Error While Storing Tld');
        }
        return back();
    }

    /**
     * Pull & Save TLds from Reseller Club
     * @return Response
     */
    public function pullSaveTldsFromResellerClub()
    {
        $api = new ApiCall();
        /*$result = $api->addContact("ResellerClub",
            [
                'customer-id' => '18775943',
                'name'  => 'TEST NAME',
                'company'   => 'TEST COMP',
                'email' => 'testusre123@testuser.com',
                'address-line-1' => 'test address',
                'city'  => 'Lahore',
                'country'   => 'PK',
                'zipcode'   => '54000',
                'phone-cc' => '92',
                'phone' => '1231231321',
                'type'  => 'Contact'
            ]);
        dd($result);*/
        $result = $api->getTlds('ResellerClub');
        $tld_prices = $api->getCostPriceOfTld("ResellerClub");
        $tlds_count = 0;
        $inserted_count = 0;
        $sequence_count =  Tld::max('sequence');
        if ($result->resultData) {
            $tlds_count = count($result->resultData);
            foreach ($result->resultData as $tld_name => $tld_data) {
                $sequence_count++;
                $existing_tld = Tld::where(['name' => $tld_name])->first();
                if (!$existing_tld) {
                    $data = [
                        'name' => $tld_name,
                        'sequence'  => $sequence_count,
                        'feature' => 'Regular',
                        'is_active_for_sale' => 0,
                        'registrar' => 'ResellerClub',
                        'suggest_group' => 'none'
                    ];
                    if(isset($tld_prices[$tld_name])){
                        if(isset($tld_prices[$tld_name]['addnewdomain'][1])){
                            $data['cost_price'] = (double) $tld_prices[$tld_name]['addnewdomain'][1];
                        }
                        if(isset($tld_prices[$tld_name]['addtransferdomain'][1])){
                            $data['transfer_price'] = (double) $tld_prices[$tld_name]['addtransferdomain'][1];
                        }
                        if(isset($tld_prices[$tld_name]['restoredomain'][1])){
                            $data['restore_price'] = (double) $tld_prices[$tld_name]['restoredomain'][1];
                        }
                    }
                    $new_tld = Tld::create($data);
                    if ($new_tld){
                        $inserted_count++;
                    }
                }
                else{
                    $data = [];
                    if(isset($tld_prices[$tld_name])){
                        if(isset($tld_prices[$tld_name]['addnewdomain'][1])){
                            $data['cost_price'] = (double) $tld_prices[$tld_name]['addnewdomain'][1];
                        }
                        if(isset($tld_prices[$tld_name]['addtransferdomain'][1])){
                            $data['transfer_price'] = (double) $tld_prices[$tld_name]['addtransferdomain'][1];
                        }
                        if(isset($tld_prices[$tld_name]['restoredomain'][1])){
                            $data['restore_price'] = (double) $tld_prices[$tld_name]['restoredomain'][1];
                        }
                    }
                    if($data) {
                        Tld::where('name', $tld_name)->update($data);
                    }
                }
            }
        }

        session()->put('success', $tlds_count.' Tlds have been pulled! '.$inserted_count.'Tlds have been inserted!');


        return redirect('domain/tld');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $tld = Tld::findOrFail($id);
        return view('domain::tlds.show', compact('tld'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return redirect()->route('tld.show',$id);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function storeOtherDetails(TldOtherRequest $request)
    {
        //need validation here

        $tldId = Request()->pk;
        $tldField = Request()->name;
        $value = Request()->value;
        if ($value == '0') {
            $value = NULL;
        }
        try {
            $tld = Tld::findOrFail($tldId);
            $tld->$tldField = $value;
            $tld->save();
            return response()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in Updation!',400);
        }
    }

    public function saveContinent(Request $request)
    {
        try {
            $tld = Tld::findOrFail(Request()->pk);
            $tld->continents()->sync(Request()->value);
            return response()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in Updation!',400);
        }

    }

    public function saveCategoryGroup(Request $request)
    {
        try {
            $tld = Tld::findOrFail(Request()->pk);
            $tld->tldGroups()->sync(Request()->value);
            return resp/onse()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in Updation!',400);
        }

    }

    public function tldDetails(){

        $data = array();
        $all_continents = Continent::all();
        $tld_groups = TldGroup::all();
        $tld_country = Country::all();
        $data['current_tld'] = array();
        $data['is_edit'] = 0;
        if (null !== (Request::segment(5))) {
            $tld_id = Request::segment(5);
            $tld = Tld::findOrFail($tld_id);
            $data['is_edit'] = 1;
            $data['current_tld'] = $tld;

            $data['selected_continent'] = DB::table('continent_tld')
                ->join('continents','continents.id','continent_tld.continent_id')
                ->where('tld_id',$tld_id)->get();

            $data['selected_category'] = DB::table('category_tld')
                ->join('tld_groups','tld_groups.id','category_tld.tld_group_id')
                ->where('tld_id',$tld_id)->get();

            $data['selected_restricted_countries'] = DB::table('restricted_countries_tld')
                ->join('countries','countries.id','restricted_countries_tld.country_id')
                ->where('tld_id',$tld_id)->get();

            $data['selected_features_services'] = DB::table('tlds_features_services')->where('tld_id',$tld_id)->get();
            $data['selected_renewal_prices'] = DB::table('tlds_renewal_prices')->where('tld_id',$tld_id)->get();
            $data['selected_prices'] = DB::table('tlds_prices')->where('tld_id',$tld_id)->get();
        }
        $api = new ApiCall();
        $data['cost_price_of_tld_reseller_club'] = $api->getCostPriceOfTld('ResellerClub');
        $data['cost_price_of_tld_open_srs'] = array();

        $data['all_continents'] = $all_continents;
        $data['tld_groups'] = $tld_groups;
        $data['tld_country'] = $tld_country;
        $data['privacy_protection_price_of_reseller_club'] = $api->getPrivacyProtectionPrice('ResellerClub');
        $data['dns_price_of_reseller_club'] = 0;
        $data['theft_protection_price_of_reseller_club'] = 0;
        $data['gdrp_price_of_reseller_club'] = 0;
        $data['domain_secret_price_of_reseller_club'] = 0;
        $data['dnssec_price_of_reseller_club'] = 0;
        $data['child_name_server_price_of_reseller_club'] = 0;
        $data['domain_forwarding_price_of_reseller_club'] = 0;
        $data['wap_price_of_reseller_club'] = 0;
        $data['chat_price_of_reseller_club'] = 0;
        $data['free_email_price_of_reseller_club'] = 0;
        $data['name_server_price_of_reseller_club'] = 0;

        $data['tld_store_error'] = Session::get('tld_store_error');
        session(['tld_store_error' => array()]);
        return view('domain::tlds.details', ['data' => $data]);
    }

    public function create_raw_data(){
        $continents = Continent::all();
        $tld_groups = TldGroup::all();
        return view('domain::domains.create_tld_row',['continents' => $continents, 'tld_groups' => $tld_groups]);
    }

    public function store_tld(Request $request){
        $input = Request::all();
        $api = new ApiCall();

        $tld_info = array();
        $error = array();
        $all_tlds = Tld::all();
        $get_last_sequence = $all_tlds->sortByDesc('sequence')->first();
        $bulk_eligible_limit = 0;
        $max_register_years = 0;
        $min_register_years = 0;
        $max_renew_years = 0;
        $min_renew_years = 0;
        $max_cancellation_period = 0;
        $restore_price = 0;
        $cancellation_price = 0;
        $renewal_price = 0;
        $transfer_price = 0;


        $cost_price_of_tld = $api->getCostPriceOfTld('ResellerClub', ['tld'=>$input['product_name']]);
        if (!empty($cost_price_of_tld)) {
            if (isset($cost_price_of_tld['addnewdomain'])) {
                if (isset($cost_price_of_tld['addnewdomain'][1])) {
                    $tld_info['cost_price'] = $cost_price_of_tld['addnewdomain'][1];
                }
            }
        }
        if(!isset($tld_info['cost_price'])) {
            $error[] = __('admin.domain.tld.invalid_cost');
        }

        if (empty($input['product_name'])) {
            $error[] = __('admin.domain.tld.invalid_product_name');
        }

        if (empty($input['provider'])) {
            $error[] = __('admin.domain.tld.invalid_registrar');
        }

        if (empty($input['max_cancellation_period'])) {
            $error[] = __('admin.domain.tld.invalid_maximum_calculation_period');
        }

        if (!empty($input['bulk_eligible_limit'])) {
            if ($input['bulk_eligible_limit'] == '?') {
                $error[] = __('admin.domain.tld.invalid_bulk_eligible_limit');
            } else {
                $bulk_eligible_limit = explode("number:", $input['bulk_eligible_limit'])[1];
            }
        } else {
            $error[] = __('admin.domain.tld.invalid_bulk_eligible_limit');
        }

        if (!empty($input['max_register_years'])) {
            if ($input['max_register_years'] == '?') {
                $error[] = __('admin.domain.tld.invalid_max_registration_year');
            } else {
                $max_register_years = explode("number:", $input['max_register_years'])[1];
            }
        } else {
            $error[] = __('admin.domain.tld.invalid_max_registration_year');
        }

        if (!empty($input['min_register_years'])) {
            if ($input['min_register_years'] == '?') {
                $error[] = __('admin.domain.tld.invalid_min_registration_year');
            } else {
                $min_register_years = explode("number:", $input['min_register_years'])[1];
                if ($min_register_years > $max_register_years) {
                    $error[] = __('admin.domain.tld.invalid_min_registration_year_greater');
                }
            }
        } else {
            $error[] = __('admin.domain.tld.invalid_min_registration_year');
        }

        if (!empty($input['max_renew_years'])) {
            if ($input['max_renew_years'] == '?') {
                $error[] = __('admin.domain.tld.invalid_max_renew_years');
            } else {
                $max_renew_years = explode("number:", $input['max_renew_years'])[1];
            }
        } else {
            $error[] = __('admin.domain.tld.invalid_max_renew_years');
        }

        if (!empty($input['min_renew_years'])) {
            if ($input['min_renew_years'] == '?') {
                $error[] = __('admin.domain.tld.invalid_min_renew_years');
            } else {
                $min_renew_years = explode("number:", $input['min_renew_years'])[1];
                if ($min_renew_years > $max_renew_years) {
                    $error[] = __('admin.domain.tld.invalid_min_renew_years_should_not_be_greater');
                }
            }
        } else {
            $error[] = __('admin.domain.tld.invalid_min_renew_years');
        }

        if (!empty($input['max_cancellation_period'])) {
            $max_cancellation_period  =  $input['max_cancellation_period'] ? str_replace(',','.',$input['max_cancellation_period']) : 0;
        } else {
            $error[] = __('admin.domain.tld.invalid_max_cancel_period');
        }
        if (!empty($input['renewal_price'])) {
            $renewal_price  = $input['renewal_price'] ? str_replace(',','.',$input['renewal_price']) : 0;
        } else {
            $error[] = __('admin.domain.tld.renewal_price');
        }
        if (!empty($input['transfer_price'])) {
            $transfer_price = $input['transfer_price'] ? str_replace(',','.',$input['transfer_price']) : 0;
        } else {
            $error[] = __('admin.domain.tld.invalid_transfer_price');
        }

        if (!empty($input['cancellation_price'])) {
            $cancellation_price = $input['cancellation_price'] ? str_replace(',','.',$input['cancellation_price']) : 0;
        } else {
            $error[] = __('admin.domain.tld.invalid_cancel_period');
        }

        if (!empty($input['restore_price'])) {
            $restore_price = $input['restore_price'] ? str_replace(',','.',$input['restore_price']) : 0;
        } else {
            $error[] = __('admin.domain.tld.invalid_restore_price');
        }

        if (empty($input['grace_period'])) {
            $error[] = __('admin.domain.tld.invalid_grace_price');
        }

        if (empty($input['restore_period'])) {
            $error[] = __('admin.domain.tld.invalid_restore_period');
        }

        if (empty($input['min_renewal_limit'])) {
            $error[] = __('admin.domain.tld.invalid_min_renewal_limit');
        }


        $domain_prices_regular_price = Request()->domain_prices_regular_price;
        if(!empty($domain_prices_regular_price)){
            foreach ($domain_prices_regular_price as $key => $val) {
                $index_of_price = $key + 1;
                $one_less_index = $key - 1;
                if(empty($input['domain_prices_year'][$key])) {
                    $error[] = __('admin.domain.tld.invalid_year_registration_promo_number')." : ".$index_of_price;
                }
                if(empty($input['domain_prices_regular_price'][$key])) {
                    $error[] = __('admin.domain.tld.invalid_regular_registration_price_promo_number')." : " . $index_of_price;
                }
                if(empty($input['domain_prices_promo_from'][$key])) {
                    $error[] = __('admin.domain.tld.invalid_promo_date_registration_price_promo_number')." : "  . $index_of_price;
                }
                if(empty($input['domain_prices_promo_to'][$key])) {
                    $error[] = __('admin.domain.tld.invalid_promo_date_to_registration_price_promo_number')." : "  . $index_of_price;
                }
                if(empty($input['domain_prices_promo_price'][$key])) {
                    $error[] =  __('admin.domain.tld.invalid_promo_price_registration_price_promo_number')." : " . $index_of_price;
                }
                if(empty($input['domain_prices_bulk_price'][$key])) {
                    $error[] = __('admin.domain.tld.invalid_bulk_price_registration_price_promo_number')." : "  . $index_of_price;
                } else if($one_less_index != '-1') {
                    if(isset($input['renewal_prices_promo_price'][$key])) {
                        if (str_replace(',', '.', $input['renewal_prices_promo_price'][$key]) >
                            str_replace(',', '.', $input['renewal_prices_promo_price'][$one_less_index])) {
                            if ($key > 0)
                                $error[] = __('admin.domain.tld.invalid_promo_price_less_than_registration_year_promo_number') . " : " . $index_of_price;
                        }
                    }
                }
            }
        }

        $renewal_prices_regular_price = Request()->renewal_prices_year;
        if(!empty($renewal_prices_regular_price)){
            foreach ($renewal_prices_regular_price as $key => $val) {
                $index_of_price = $key + 1;
                $one_less_index = $key - 1;
                if(empty($input['renewal_prices_year'][$key])) {
                    $error[] = 'Invalid years for Renewal & Transfer Prices for promo number : ' . $index_of_price;
                }
                if(empty($input['renewal_prices_regular_price'][$key])) {
                    $error[] = 'Invalid regular price for Renewal & Transfer Prices for promo number : ' . $index_of_price;
                }
                if(empty($input['renewal_prices_promo_from'][$key])) {
                    $error[] = 'Invalid promo from-date for Renewal & Transfer Prices for promo number : ' . $index_of_price;
                }
                if(empty($input['renewal_prices_promo_to'][$key])) {
                    $error[] = 'Invalid promo from-to for Renewal & Transfer Prices for promo number : ' . $index_of_price;
                }
                if(empty($input['renewal_prices_promo_price'][$key])) {
                    $error[] = 'Invalid promo price from-to for Renewal & Transfer Prices for promo number : ' . $index_of_price;
                } else if($one_less_index != '-1') {
                    if ($input['renewal_prices_promo_price'][$key]) {
                        if (str_replace(',', '.', $input['renewal_prices_promo_price'][$key]) >
                            str_replace(',', '.', $input['renewal_prices_promo_price'][$one_less_index])) {
                            if ($key > 0)
                                $error[] = "Promo price must be less than its earlier year's value Renewal & Transfer Prices for promo number : " . $index_of_price;
                        }
                    }
                }
            }
        }

        $tld_info['name'] = $input['product_name'];
        $tld_info['registrar'] = $input['provider'];
        $tld_info['suggest_group'] = $input['suggest_group'];
        $tld_info['bulk_price_limit'] = $bulk_eligible_limit;
        $tld_info['max_purchase_limit'] = $max_register_years;
        $tld_info['min_purchase_limit'] = $min_register_years;
        $tld_info['max_renewal_limit'] = $max_renew_years;
        $tld_info['min_renewal_limit'] = $min_renew_years;
        $tld_info['max_cancellation_days'] = $input['max_cancellation_period'];
        $tld_info['cancellation_fees'] = $cancellation_price;
        $tld_info['grace_period'] = $input['grace_period'];
        $tld_info['restore_period'] = $input['restore_period'];
        $tld_info['restore_price'] = $restore_price;
        $tld_info['min_renewal_time'] = $input['min_renewal_limit'];
        $tld_info['renewal_price'] = 1;
        $tld_info['force_fully_active'] = 0;
        if (!empty($get_last_sequence)) {
            $tld_info['sequence'] = $get_last_sequence->sequence + 1;
        } else {
            $tld_info['sequence'] = 1;
        }
        $tld_info['is_active_for_sale'] = 0;
        $tld_info['feature'] = 'Regular';//ask
        $tld_info['transfer_price'] = $transfer_price;//ask

        if (!empty($error)) {
            session(['tld_store_error' => $error]);
            return back();
        }

        try {
            if(isset($input['mtld_id'])) {
                $tld_id = $input['mtld_id'];
                $tld_info['id'] = $tld_id;

                $tld = DB::table('tlds')->whereIn('id', [$tld_id])->update($tld_info);
            } else {
                $tld = Tld::create($tld_info);
                $tld_id = $tld->id;
            }
            if ($tld) {

                $continent_data = array();
                $tld_group_data = array();
                $tld_country_restricted_data= array();

                $continents = array();
                $tld_groups = array();
                $countries = array();

                if(!empty(json_decode(Request()->continents))) {
                    foreach (json_decode(Request()->continents) as $cont) {
                        $continents[] = $cont->id;
                    }
                }

                if(!empty(json_decode(Request()->categories))) {
                    foreach (json_decode(Request()->categories) as $cat) {
                        $tld_groups[] = $cat->id;
                    }
                }
                if(!empty(json_decode(Request()->country_restricted))) {
                    foreach (json_decode(Request()->country_restricted) as $country) {
                        $countries[] = $country->id;
                    }
                }

                $continent_data['tld_id'] = $tld_id;
                $continent_data['continents'] = $continents;
                $this->store_continent_tld($continent_data);

                $tld_group_data['tld_id'] = $tld_id;
                $tld_group_data['tld_groups'] = $tld_groups;
                $this->store_tld_category_group($tld_group_data);

                $tld_country_restricted_data['tld_id'] = $tld_id;
                $tld_country_restricted_data['country_id'] = $countries;
                $this->store_restricted_countries_tld($tld_country_restricted_data);

                $domain_prices_regular_price = Request()->domain_prices_regular_price;
                if(!empty($domain_prices_regular_price)){

                    foreach ($domain_prices_regular_price as $key => $val) {
                        $promo_details= array();
                        $promo_details['tld_id'] = $tld_id;
                        $promo_details['year'] = $input['domain_prices_year'][$key];
                        $promo_details['regular_price'] = str_replace(',','.',$input['domain_prices_regular_price'][$key]);
                        $promo_details['promo_price'] = str_replace(',','.',$input['domain_prices_promo_price'][$key]);
                        if(!empty($promo_details['promo_price']) || $promo_details['promo_price'] != 0) {
                            $promo_details['promo_from'] = date('Y-m-d H:i:s', strtotime($input['domain_prices_promo_from'][$key]));
                            $promo_details['promo_to'] = date('Y-m-d H:i:s', strtotime($input['domain_prices_promo_to'][$key]));
                        } else {
                            $promo_details['promo_from'] = '';
                            $promo_details['promo_to'] = '';
                        }
                        if (!empty($bulk_eligible_limit) || $bulk_eligible_limit != 0) {
                            $promo_details['bulk_price'] = str_replace(',', '.', $input['domain_prices_bulk_price'][$key]);
                        } else {
                            $promo_details['bulk_price'] = 0;
                        }
                        $old_price = DB::table('tlds_prices')->where('tld_id',$tld_id)->where('year',$promo_details['year'])->get();
                        if(isset($old_price[0])) {
                            DB::table('tlds_prices')->where('tld_id', $tld_id)->where('year',$promo_details['year'])->update($promo_details);
                        } else {
                            TldsPrices::create($promo_details);
                        }
                    }
                }

                $renewal_prices_regular_price = Request()->renewal_prices_year;
                if(!empty($renewal_prices_regular_price)){
                    foreach ($renewal_prices_regular_price as $key => $val) {
                        $renewal_details= array();
                        $renewal_details['tld_id'] = $tld_id;
                        $renewal_details['year'] = $input['renewal_prices_year'][$key];
                        $renewal_details['renewal_price'] = str_replace(',','.',$input['renewal_prices_regular_price'][$key]);
                        $renewal_details['promo_price'] = str_replace(',','.',$input['renewal_prices_promo_price'][$key]);
                        if(!empty($renewal_details['promo_price']) || $renewal_details['promo_price'] != 0) {
                            $renewal_details['promo_from'] = date('Y-m-d H:i:s', strtotime($input['renewal_prices_promo_from'][$key]));
                            $renewal_details['promo_to'] = date('Y-m-d H:i:s', strtotime($input['renewal_prices_promo_to'][$key]));
                        } else {
                            $renewal_details['promo_from'] = '';
                            $renewal_details['promo_to'] = '';
                        }
                        $old_price = DB::table('tlds_renewal_prices')->where('tld_id',$tld_id)->where('year',$renewal_details['year'])->get();
                        if(isset($old_price[0])) {
                            DB::table('tlds_renewal_prices')->where('tld_id', $tld_id)->where('year',$renewal_details['year'])->update($renewal_details);
                        } else {
                            TldsRenewalPrices::create($renewal_details);
                        }
                    }
                }


                $tld_feature_service = array();
                $tld_feature_service['dns_cost_price'] = $input['dns_cost_price'] ? str_replace(',','.',$input['dns_cost_price']) : 0;
                $tld_feature_service['dns_service_type'] = $input['dns_service_type'];
                $tld_feature_service['dns_price'] = $input['dns_price'] ? str_replace(',','.',$input['dns_price']) : 0;
                $tld_feature_service['dns_activation_fee'] = $input['dns_act_fee'] ? str_replace(',','.',$input['dns_act_fee']) : 0;
                $tld_feature_service['dns_duration'] = $input['dns_duration'];
                $tld_feature_service['is_dns_active'] = isset($input['dns_status']) ? 1 : 0;

                $tld_feature_service['privacy_protection_cost_price'] = $input['privacy_protection_cost_price'] ? str_replace(',','.',$input['privacy_protection_cost_price']) : 0;
                $tld_feature_service['privacy_protection_service_type'] = $input['privacy_protection_service_type'];
                $tld_feature_service['privacy_protection_price'] = $input['privacy_protection_price'] ? str_replace(',','.',$input['privacy_protection_price']) : 0;
                $tld_feature_service['privacy_protection_activation_fee'] = $input['privacy_protection_act_fee'] ? str_replace(',','.',$input['privacy_protection_act_fee']) : 0;
                $tld_feature_service['privacy_protection_duration'] = $input['privacy_protection_duration'];
                $tld_feature_service['is_privacy_protection_active'] = isset($input['privacy_protection_status']) ? 1 : 0;

                $tld_feature_service['theft_protection_price'] = $input['theft_protection_price'] ? str_replace(',','.',$input['theft_protection_price']) : 0;
                $tld_feature_service['is_theft_protection_active'] = isset($input['theft_protection_status']) ? 1 : 0;
                $tld_feature_service['theft_protection_service_type'] = $input['theft_protection_service_type'];
                $tld_feature_service['theft_protection_duration'] = $input['theft_protection_duration'];
                $tld_feature_service['theft_protection_cost_price'] = $input['theft_protection_cost_price'] ? str_replace(',','.',$input['theft_protection_cost_price']) : 0;
                $tld_feature_service['theft_protection_activation_fee'] = $input['theft_protection_act_fee'] ? str_replace(',','.',$input['theft_protection_act_fee']) : 0;

                $tld_feature_service['child_name_server_price'] = $input['child_name_server_price'] ? str_replace(',','.',$input['child_name_server_price']) : 0;
                $tld_feature_service['is_child_name_server_active'] = isset($input['child_name_server_status']) ? 1 : 0;
                $tld_feature_service['child_name_server_service_type'] = $input['child_name_server_service_type'];
                $tld_feature_service['child_name_server_duration'] = $input['child_name_server_duration'];
                $tld_feature_service['child_name_server_cost_price'] = $input['child_name_server_cost_price'] ? str_replace(',','.',$input['child_name_server_cost_price']) : 0;
                $tld_feature_service['child_name_server_activation_fee'] = $input['child_name_server_act_fee'] ? str_replace(',','.',$input['child_name_server_act_fee']) : 0;

                $tld_feature_service['is_domain_secret_active'] = isset($input['domain_secret_status']) ? 1 : 0;
                $tld_feature_service['domain_secret_price'] = $input['domain_secret_price'] ? str_replace(',','.',$input['domain_secret_price']) : 0;
                $tld_feature_service['domain_secret_service_type'] = $input['domain_secret_service_type'];
                $tld_feature_service['domain_secret_duration'] = $input['domain_secret_duration'];
                $tld_feature_service['domain_secret_cost_price'] = $input['domain_secret_cost_price'] ? str_replace(',','.',$input['domain_secret_cost_price']) : 0;
                $tld_feature_service['domain_secret_activation_fee'] = $input['domain_secret_act_fee'] ? str_replace(',','.',$input['domain_secret_act_fee']) : 0;

                $tld_feature_service['is_domain_forwarding_active'] = isset($input['domain_forwarding_status']) ? 1 : 0;
                $tld_feature_service['domain_forwarding_price'] = $input['domain_forwarding_price'] ? str_replace(',','.',$input['domain_forwarding_price']) : 0;
                $tld_feature_service['domain_forwarding_service_type'] = $input['domain_forwarding_service_type'];
                $tld_feature_service['domain_forwarding_duration'] = $input['domain_forwarding_duration'];
                $tld_feature_service['domain_forwarding_cost_price'] = $input['domain_forwarding_cost_price'] ? str_replace(',','.',$input['domain_forwarding_cost_price']) : 0;
                $tld_feature_service['domain_forwarding_activation_fee'] = $input['domain_forwarding_act_fee'] ? str_replace(',','.',$input['domain_forwarding_act_fee']) : 0;

                $tld_feature_service['is_name_server_active'] = isset($input['name_servers_status']) ? 1 : 0;
                $tld_feature_service['name_server_price'] = $input['name_servers_price'] ? str_replace(',','.',$input['name_servers_price']) : 0;
                $tld_feature_service['name_server_service_type'] = $input['name_servers_service_type'];
                $tld_feature_service['name_server_duration'] = $input['name_servers_duration'];
                $tld_feature_service['name_server_cost_price'] = $input['name_servers_cost_price'] ? str_replace(',','.',$input['name_servers_cost_price']) : 0;
                $tld_feature_service['name_server_activation_fee'] = $input['name_servers_act_fee'] ? str_replace(',','.',$input['name_servers_act_fee']) : 0;

                $tld_feature_service['is_wap_active'] = isset($input['wap_status']) ? 1 : 0;
                $tld_feature_service['wap_price'] = $input['wap_price'] ? str_replace(',','.',$input['wap_price']) : 0;
                $tld_feature_service['wap_service_type'] = $input['wap_service_type'];
                $tld_feature_service['wap_duration'] = $input['wap_duration'];
                $tld_feature_service['wap_cost_price'] = $input['wap_cost_price'] ? str_replace(',','.',$input['wap_cost_price']) : 0;
                $tld_feature_service['wap_activation_fee'] = $input['wap_act_fee'] ? str_replace(',','.',$input['wap_act_fee']) : 0;

                $tld_feature_service['is_chat_active'] = isset($input['chat_status']) ? 1 : 0;
                $tld_feature_service['chat_price'] = $input['chat_price'] ? str_replace(',','.',$input['chat_price']) : 0;
                $tld_feature_service['chat_service_type'] = $input['chat_service_type'];
                $tld_feature_service['chat_duration'] = $input['chat_duration'];
                $tld_feature_service['chat_cost_price'] = $input['chat_cost_price'] ? str_replace(',','.',$input['chat_cost_price']) : 0;
                $tld_feature_service['chat_activation_fee'] = $input['chat_act_fee'] ? str_replace(',','.',$input['chat_act_fee']) : 0;

                $tld_feature_service['is_free_email_active'] = isset($input['free_email_status']) ? 1 : 0;
                $tld_feature_service['free_email_price'] = $input['free_email_price'] ? str_replace(',','.',$input['free_email_price']) : 0;
                $tld_feature_service['free_email_service_type'] = $input['free_email_service_type'];
                $tld_feature_service['free_email_duration'] = $input['free_email_duration'];
                $tld_feature_service['free_email_cost_price'] = $input['free_email_cost_price'] ? str_replace(',','.',$input['free_email_cost_price']) : 0;
                $tld_feature_service['free_email_activation_fee'] = $input['free_email_act_fee'] ? str_replace(',','.',$input['free_email_act_fee']) : 0;

                $tld_feature_service['gdrp_protection_active'] = isset($input['gdrp_status']) ? 1 : 0;
                $tld_feature_service['gdrp_protection_price'] = $input['gdrp_price'] ? str_replace(',','.',$input['gdrp_price']) : 0;
                $tld_feature_service['gdrp_protection_service_type'] = $input['gdrp_service_type'];
                $tld_feature_service['gdrp_protection_duration'] = $input['gdrp_duration'];
                $tld_feature_service['gdrp_protection_cost_price'] = $input['gdrp_cost_price'] ? str_replace(',','.',$input['gdrp_cost_price']) : 0;
                $tld_feature_service['gdrp_protection_activation_fee'] = $input['gdrp_act_fee'] ? str_replace(',','.',$input['gdrp_act_fee']) : 0;

                $tld_feature_service['dnssec_active'] = isset($input['dnssec_status']) ? 1 : 0;
                $tld_feature_service['dnssec_price'] = $input['dnssec_price'] ? str_replace(',','.',$input['dnssec_price']) : 0;
                $tld_feature_service['dnssec_service_type'] = $input['dnssec_service_type'];
                $tld_feature_service['dnssec_duration'] = $input['dnssec_duration'];
                $tld_feature_service['dnssec_cost_price'] = $input['dnssec_cost_price'] ? str_replace(',','.',$input['dnssec_cost_price']) : 0;
                $tld_feature_service['dnssec_activation_fee'] = $input['dnssec_act_fee'] ? str_replace(',','.',$input['dnssec_act_fee']) : 0;

                $tld_feature_service['min_nameserver_limit'] = $input['min_nameserver_limit'] ? str_replace(',','.',$input['min_nameserver_limit']) : 0;
                $tld_feature_service['max_nameserver_limit'] = $input['max_nameserver_limit'] ? str_replace(',','.',$input['max_nameserver_limit']) : 0;
                $tld_feature_service['tld_id'] = $tld_id;
                $old_features_services = DB::table('tlds_features_services')->where('tld_id',$tld_id)->get();
                if(isset($old_features_services[0])) {
                    DB::table('tlds_features_services')->where('tld_id', $tld_id)->update($tld_feature_service);
                } else {
                    TldsFeaturesServices::create($tld_feature_service);
                }
            }
            session()->put('success', 'Tld Stored Successfully');

        } catch (\Exception $e) {
            session()->put('error', 'Error While Storing Tld');
        }
        return back();
    }
    public function store_raw_data(Request $request){
        $input = Request()::all();
        //to get cost price.
        $domain = 'example'.Request()->name;
        //check the registrar
        if (Request()->registrar == 'OpenSRS')
        {
            //API call for the cost price
            $lookUpArray = [
                'func' => 'GetPrice',
                'attributes' => [
                    'domain' => $domain
                ]
            ];
            $callString = json_encode($lookUpArray);
            $processRequest = new ProcessRequest();
            $openSrsHandler = $processRequest->processData($callString);
            $resultData = $openSrsHandler->resultData;
            try {
                $price = $resultData['attributes']['price'];
                $input['cost_price'] = $price;
            } catch(\Exception $e) {

            }

        }
        try {
            $tld = Tld::create($input);

            if ($tld) {
                $tld_id = $tld->id;
                $continent_data = array();
                $tld_group_data = array();
                $continent_data['tld_id'] = $tld_id;
                $continent_data['continents'] = Request()->continents;
                $this->store_continent_tld($continent_data);

                $tld_group_data['tld_id'] = $tld_id;
                $tld_group_data['tld_groups'] = Request()->tld_groups;
                $this->store_tld_category_group($tld_group_data);
            }
            session()->put('success', 'Tld Stored Successfully');

        } catch (\Exception $e) {
            session()->put('error', 'Error While Storing Tld');
        }
        return back();
    }

    public function store_continent_tld($data) {
        try {
            DB::table('continent_tld')->where('tld_id',$data['tld_id'])->delete();
            if(!empty($data['continents'])) {
                $tld = Tld::findOrFail($data['tld_id']);
                $tld->continents()->sync($data['continents']);
            }
            return response()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in Updation!',400);
        }
    }

    public function store_tld_category_group($data) {
        try {
            DB::table('category_tld')->where('tld_id',$data['tld_id'])->delete();
            if(!empty($data['tld_groups'])) {
                foreach ($data['tld_groups'] as $group) {
                    CategoryTld::create(array('tld_id' => $data['tld_id'],'tld_group_id' => $group));
                }
            }
            return resp/onse()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in Updation!',400);
        }
    }

    public function store_restricted_countries_tld($data) {
        try {
            DB::table('restricted_countries_tld')->where('tld_id',$data['tld_id'])->delete();
            if(!empty($data['country_id'])) {
                foreach ($data['country_id'] as $country) {
                    restricted_countries_tld::create(array('tld_id' => $data['tld_id'],'country_id' => $country));
                }
            }
            return resp/onse()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in Updation!',400);
        }
    }

    public function tld_active_inactive_for_sale(Request $request){
        try {
            $tld = Tld::find(Request()->tld_id);
            $tld->is_active_for_sale = Request()->is_active_for_sale;
            $tld->force_fully_active = Request()->force_fully_active;
            $tld->save();
            return response()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in state changing!',400);
        }
    }

    public function change_registrar(Request $request){
        try {
            $tld = Tld::find(Request()->tld_id);
            $tld->registrar = Request()->registrar;
            $tld->save();
            return response()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in state changing!',400);
        }
    }

    public function change_sequence(Request $request){
        try {
            $orders = Request()->order;
            for ($i=0; $i < count($orders); $i++){
                $k = $i+1;
                $single_tld = Tld::findOrFail($orders[$i]);
                $single_tld->sequence = $k;
                $single_tld->save();
            }
            return response()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in state changing!',400);
        }
    }

    public function tld_active_force_fully(Request $request){
        try {
            $tld = Tld::find(Request()->tld_id);
            $tld->is_active_for_sale = Request()->is_active_for_sale;
            $tld->force_fully_active = Request()->force_fully_active;
            $tld->save();
            return response()->json(['success' => 'Success']);
        } catch(\Exception $e) {
            return response()->json('Error in state changing!',400);
        }
    }


}
