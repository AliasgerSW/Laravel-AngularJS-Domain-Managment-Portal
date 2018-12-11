<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\TldsRenewalPrices;

class TldsRenewalPricesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $dateRange =explode(' - ',$input['renewal_date_range']);
        $input['promo_from'] = $dateRange[0];
        $input['promo_to'] = $dateRange[1];
        try {
            $tldsRenewalPrices = TldsRenewalPrices::create($input);
            return response()->json(['success' => 'Success', 'tldsPrice' => $tldsRenewalPrices]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Error in Saving']);
        }

    }

    public function update(Request $request)
    {
        $id = $request->id;
        $fieldName = $request->name;
        $tldId = $request->tld_id;
        $value = $request->value;
        try {
            $tldPrice = TldsRenewalPrices::find($id);
            $tldPrice->$fieldName = $value;
            $tldPrice->save();
            return response()->json(['success'=>'Successfully Updated']);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Error in Updation!']);
        }
    }

    public function destroy($id)
    {
        try {
            $tldPrice = TldsRenewalPrices::findOrFail($id);
            $tldPrice->delete();
            return response()->json(['title' => 'Delete Price', 'msg' => 'Successfully Deleted']);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Error in deletion!', 'title' => 'Delete Price']);
        }
    }
}
