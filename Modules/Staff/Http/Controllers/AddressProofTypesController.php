<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\AddressProofTypes;
use Modules\Staff\Http\Requests\AddressProofTypeCreateRequest;
use Modules\Staff\Http\Requests\AddressProofTypeUpdateRequest;
use Modules\GEO\Entities\Country;

class AddressProofTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $addressProofTypes = AddressProofTypes::orWhere("proof_name", "LIKE", "%". request()->get('search') ."%")
                ->paginate(10);
        }else{
            $addressProofTypes = AddressProofTypes::paginate(10);
        }
        return view('staff::addressProofTypes.index',compact('addressProofTypes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $countriesList = Country::pluck('name', 'id');
        return view('staff::addressProofTypes.create-edit', compact('countriesList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(AddressProofTypeCreateRequest $request)
    {
        $allRequests = $request->all();
        $allRequests['accepted_at'] = implode(',', $allRequests['accepted_at']);

        AddressProofTypes::create($allRequests);
        session()->put('success','Address Proof created successfully');

        return redirect()->route('addressProofType.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(AddressProofTypes $addressProofTypes)
    {
        return view('staff::addressProofTypes.show', compact('addressProofTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(AddressProofTypes $addressProofType)
    {
        $addressProofType->accepted_at = explode(',', $addressProofType->accepted_at);

        $countriesList = Country::pluck('name', 'id');
        return view('staff::addressProofTypes.create-edit', compact('addressProofType', 'countriesList'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id, AddressProofTypeUpdateRequest $request)
    {
        $allRequests = $request->all();
        $allRequests['accepted_at'] = implode(',', $allRequests['accepted_at']);

        AddressProofTypes::find($id)->update($allRequests);
        session()->put('success','Address Proof updated successfully');

        return redirect()->route('addressProofType.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(AddressProofTypes $addressProofType)
    {
        $addressProofType->delete();
        session()->put('success','Address Proof deleted successfully');

        return redirect()->route('addressProofType.index');
    }
}
