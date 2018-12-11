<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\StaffPositions;
use Modules\Staff\Http\Requests\StaffPositionCreateRequest;
use Modules\Staff\Http\Requests\StaffPositionUpdateRequest;
use Validator;

class StaffPositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $positions = StaffPositions::orWhere("position_name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("position_code", "LIKE", "%". request()->get('search') ."%")
                ->paginate(10);
        }else{
            $positions = StaffPositions::paginate(10);
        }
        return view('staff::position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('staff::position.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StaffPositionCreateRequest $request)
    {
        StaffPositions::create($request->all());
        session()->put('success','Position created successfully');

        return redirect()->route('position.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(StaffPositions $position)
    {
        return view('staff::position.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(StaffPositions $position)
    {
        return view('staff::position.create-edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(StaffPositions $position, StaffPositionUpdateRequest $request)
    {
        $position->update($request->all());
        session()->put('success','Position updated successfully');

        return redirect()->route('position.index');

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(StaffPositions $position)
    {
        $position->delete();
        session()->put('success','Staff Position deleted successfully');

        return redirect()->route('position.index');
    }
}
