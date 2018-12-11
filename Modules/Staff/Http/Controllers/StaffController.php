<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GEO\Entities\City;
use Modules\GEO\Entities\Country;
use Modules\GEO\Entities\State;
use Modules\Staff\Entities\AddressProofTypes;
use Modules\Staff\Entities\Staff;
use Modules\Staff\Entities\StaffPositions;
use Modules\Staff\Entities\StaffShifts;
use Modules\Staff\Http\Requests\StaffCreateRequest;
use Modules\Staff\Http\Requests\StaffUpdateRequest;
use Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $staffs = Staff::orWhere("first_name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("middle_name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("last_name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("display_name", "LIKE", "%". request()->get('search') ."%")
                ->paginate(10);
        }else{
            $staffs = Staff::paginate(10);
        }
        return view('staff::staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $pageLabel = __('admin.general.create');
        $countriesList = Country::pluck('name', 'id');
        $positionsList = StaffPositions::pluck('position_name', 'id');
        $addressProofList = AddressProofTypes::pluck('proof_name', 'id');
        $staffTimingsList = StaffShifts::pluck('shift_name', 'id');
        $addressProofTypeList = AddressProofTypes::pluck('proof_name', 'id');
        return view('staff::staff.createEdit', compact('countriesList',
            'positionsList', 'addressProofList', 'staffTimingsList','addressProofTypeList','pageLabel'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StaffCreateRequest $request)
    {
        $input = $request->all();

        // Upload Profile Image
        if ($request->has('profile_image')){
            $imageName = time().'.'.request()->profile_image->getClientOriginalExtension();
            request()->profile_image->move(public_path('uploads/staff/profile'), $imageName);
            $input['profile_image'] = "uploads/staff/profile/".$imageName;
        }

        // Address Proof Upload
        if ($request->has('document')){
            $documentName = time().'.'.request()->document->getClientOriginalExtension();
            request()->document->move(public_path('uploads/staff/document'), $documentName);
            $input['document'] = "uploads/staff/document/".$documentName;
        }

        $input['password'] = bcrypt($input['password']);

        Staff::create($input);

        session()->put('success','Staff Created Successfully');

        return redirect()->route('staffs.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    /*public function show()
    {
        return view('staff::show');
    }*/

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Staff $staff)
    {
        $pageLabel = "Edit";
        $countriesList = Country::pluck('name', 'id');
        $positionsList = StaffPositions::pluck('position_name', 'id');
        $addressProofList = AddressProofTypes::pluck('proof_name', 'id');
        $staffTimingsList = StaffShifts::pluck('shift_name', 'id');
        $cityList = City::where('state_id', $staff->state_id)->pluck('name', 'id');
        return view('staff::staff.createEdit', compact('countriesList',
            'positionsList', 'addressProofList', 'staffTimingsList','staff','cityList','pageLabel'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Staff $staff, StaffUpdateRequest $request)
    {
        $input = $request->all();

        // Upload Profile Image
        if ($request->has('profile_image')){
            $imageName = time().'.'.request()->profile_image->getClientOriginalExtension();
            request()->profile_image->move(public_path('uploads/staff/profile'), $imageName);
            $input['profile_image'] = "uploads/staff/profile/".$imageName;
        }else{
            $input = array_except($input,['profile_image']);
        }

        // Address Proof Upload
        if ($request->has('document')){
            $documentName = time().'.'.request()->document->getClientOriginalExtension();
            request()->document->move(public_path('uploads/staff/document'), $documentName);
            $input['document'] = "uploads/staff/document/".$documentName;
        }else{
            $input = array_except($input,['document']);
        }

        if ($request->has('password')){
            $input['password'] = bcrypt($input['password']);
        } else {
            $input = array_except($input,['password']);
        }

        $staff->update($input);
        session()->put('success','Staff Updated Successfully');

        return redirect()->route('staffs.index');
    }

    public function show(Staff $staff)
    {
        return view('staff::staff.show',compact('staff'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        session()->put('success','Staff Deleted Successfully');

        return redirect()->route('staffs.index');
    }

    /**
     * Fetch states.
     * @param  Request $request
     * @return Response
     */
    public function states(Request $request)
    {
        $states = State::where('country_id',$request->country_id)->pluck("name","id")->all();
        return response()->json($states);
    }

    /**
     * Fetch cities.
     * @param  Request $request
     * @return Response
     */
    public function cities(Request $request)
    {
        $cities = City::where('state_id',$request->state_id)->pluck("name","id")->all();
        return response()->json($cities);
    }
}
