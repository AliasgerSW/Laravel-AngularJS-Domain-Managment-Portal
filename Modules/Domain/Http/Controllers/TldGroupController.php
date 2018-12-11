<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\TldGroup;
use Validator;
class TldGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (request('show_deleted') == 1) {
            $tldGroups = TldGroup::onlyTrashed()->get();
        } else {
            $tldGroups = TldGroup::all();
        }

        return view('domain::groups.manage',compact('tldGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return redirect()->route('tld-group.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required | unique:tld_groups'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        try {
            $tldGroup = TldGroup::create($request->all());
            return $tldGroup;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error in Saving!']);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return redirect()->route('tld-group.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return redirect()->route('tld-group.index');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $tldGroup = TldGroup::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required | unique:tld_groups,name,'.$tldGroup->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        try {
            $tldGroup->update($request->all());
            return $tldGroup->name;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error in Updation!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $tldGroup = TldGroup::findOrFail($id);
            $tldGroup->delete();
            return response()->json(['title' => 'Delete Tld Group', 'msg' => 'Successfully Deleted']);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Error in deletion!', 'title' => 'Delete Tld Group']);
        }

    }

    public function restore($id)
    {
        try {
            $tldGroup = TldGroup::onlyTrashed()->findOrFail($id);
            $tldGroup->restore();
            return response()->json(['title' => 'Restore Tld Group', 'msg' => 'Successfully Restore']);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Error in restoration!', 'title' => 'Restore Tld Group']);
        }

    }


    public function permanentDelete($id)
    {
        try {
            $tldGroup = TldGroup::onlyTrashed()->findOrFail($id);
            $tldGroup->forceDelete();
            return response()->json(['title' => 'Permanent Delete Tld Group', 'msg' => 'Successfully Deleted']);

        } catch(\Exception $e) {
            return response()->json(['error' => 'Error in Deletion!', 'title' => 'Permanent Delete Tld Group']);
        }
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $tldGroups = TldGroup::pluck('name','id');
            return $tldGroups;
        }
    }
}
