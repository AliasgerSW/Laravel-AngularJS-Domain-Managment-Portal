<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\TldsFeaturesServices;

class TldsFeaturesServicesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $tldId = $request->pk;
        $tldField = $request->name;
        $value = $request->value;
        try {

            TldsFeaturesServices::updateOrCreate(
                ['tld_id' => $tldId],
                ['tld_id' => $tldId, $tldField => $value]
            );
            return response()->json(['success' => 'Successful']);
        } catch(\Exception $e) {
            return response()->json('Error in Updation!',400);
        }
    }


}
