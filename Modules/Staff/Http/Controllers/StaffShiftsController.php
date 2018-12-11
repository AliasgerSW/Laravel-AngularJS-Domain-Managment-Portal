<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\StaffShifts;
use Modules\Staff\Http\Requests\StaffShiftsCreateRequest;
use Modules\Staff\Http\Requests\StaffShiftsUpdateRequest;

class StaffShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $staffShifts = StaffShifts::orWhere("shift_name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("shift_descr", "LIKE", "%". request()->get('search') ."%")
                ->paginate(10);
        }else{
            $staffShifts = StaffShifts::paginate(10);
        }
        return view('staff::staffShifts.index',compact('staffShifts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('staff::staffShifts.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StaffShiftsCreateRequest $request)
    {
        StaffShifts::create($request->all());
        session()->put('success','Staff Shift Created Successfully');

        return redirect()->route('staffShifts.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(StaffShifts $staffShift)
    {
        return view('staff::staffShifts.show',compact('staffShift'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(StaffShifts $staffShift)
    {
        return view('staff::staffShifts.edit',compact('staffShift'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(StaffShifts $staffShift,StaffShiftsUpdateRequest $request)
    {
        $staffShift->update($request->all());
        session()->put('success','Staff Shift Updated Successfully');

        return redirect()->route('staffShifts.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(StaffShifts $staffShift)
    {
        $staffShift->delete();
        session()->put('success','Staff Shift Deleted Successfully');

        return redirect()->route('staffShifts.index');
    }
}
