<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\Contact;
use Modules\Domain\API\ApiCall;
use Modules\Domain\Entities\CustomerContact;
use Validator;

class DomainContactDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     * Parameters: customer_id, domain_id, type, first_name, last_name, middle_name, phone, alternative_tel_num, mobile, alternative_email, country, org_name,
     * state, city,	address1, address2, address3, postal_code, fax, notes, account_holder_position, account_holder_first_name, account_holder_last_name, all
     * @return Response
     */
    public function contactDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'domain_id' => 'required',
            'type' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'last_name' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'org_name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'postal_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        if ($request->has('all')){
            $input = $request->all();
            foreach (Contact::$types as $type){
                $input['type'] = $type;
                $this->updateDetails($type, $input);
            }
        }else{
            $this->updateDetails($request->type, $request->all());
        }

        return response()->json(['success'=>'Contact Details Updated successfully.']);
    }

    /**
     * Display a listing of the resource.
     * Parameters: customer_id, domain_id, type, first_name, last_name, middle_name, phone, phone_code, alternative_tel_num, mobile, alternative_email, country, org_name,
     * state, city,	address1, address2, address3, postal_code, fax, fax_code, notes, account_holder_position, account_holder_first_name, account_holder_last_name, all
     * @return Response
     */
    public function createContactDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'domain_id' => 'required',
            'type' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'last_name' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'org_name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'postal_code' => 'required',
            'phone_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $customer = CustomerContact::find($request->customer_id);
        if (!is_null($customer)){
            $apiCall = new ApiCall();
            $attributes['customer-id'] = $customer->resellerclub_client_id;
            $attributes['name'] = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
            $attributes['email'] = $request->email;
            $attributes['company'] = $request->org_name;
            $attributes['city'] = $request->city;
            $attributes['country'] = $request->country;
            $attributes['zipcode'] = $request->postal_code;
            $attributes['address-line-1'] = $request->address1;
            $attributes['phone-cc'] = $request->phone_code;
            $attributes['phone'] = $request->phone;
            $attributes['type'] = 'Contact';
            $attributes['state'] = $request->state;

            if ($request->has('address2')){
                $attributes['address-line-2'] = $request->address2;
            }

            if ($request->has('address3')){
                $attributes['address-line-3'] = $request->address3;
            }

            if ($request->has('fax_code')){
                $attributes['fax-cc'] = $request->fax_code;
            }

            if ($request->has('fax')){
                $attributes['fax'] = $request->fax;
            }
            return $apiCall->addContact('ResellerClub',$attributes);

            Contact::create($request->all());

        } else {
            return response()->json(['error'=>'Customer Not Found.']);
        }

        return response()->json(['error'=>'Erorrr!']);

    }

    private function updateDetails($type, $data){
        $contact = Contact::where('customer_id', $data['customer_id'])->where('type', $type)->first();

        if (!is_null($contact)){
            $contact->update($data);
        }else{
            Contact::create($data);
        }
    }
}
