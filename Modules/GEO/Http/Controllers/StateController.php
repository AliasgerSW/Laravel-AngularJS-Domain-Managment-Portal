<?php

namespace Modules\GEO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GEO\Entities\Country;
use Modules\GEO\Entities\State;
use Modules\GEO\Http\Requests\StateCreateRequest;
use Modules\GEO\Http\Requests\StateUpdateRequest;
use Modules\GEO\Http\Requests\ImportRequest;
use Validator;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $states = State::orWhere("name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("code", "LIKE", "%". request()->get('search') ."%")
                ->paginate(10);
        }else{
            $states = State::paginate(10);
        }
        return view('geo::state.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $countriesList = Country::pluck('name', 'id');
        return view('geo::state.create', compact('countriesList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StateCreateRequest $request)
    {
        State::create($request->all());
        session()->put('success',__('admin.general.alert.create',['name'=>__('admin.geo.state')]));

        return redirect()->route('states.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(State $state)
    {
        return view('geo::state.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(State $state)
    {
        $countriesList = Country::pluck('name', 'id');
        return view('geo::state.edit', compact('state','countriesList'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(State $state, StateUpdateRequest $request)
    {
        $state->update($request->all());
        session()->put('success',__('admin.general.alert.update',['name'=>__('admin.geo.state')]));

        return redirect()->route('states.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        session()->put('success',__('admin.general.alert.delete',['name'=>__('admin.geo.state')]));

        return redirect()->route('states.index');
    }

    /**
     * Export Country Data
     * @return Response CSV
     */
    public function export()
    {
        $states = State::all();
        $output='Id,Country Name, Name, Code,Created At, Updated At';

        if($states->count() > 0){
            foreach ($states as $state) {
                $state = [$state->id, $state->country->name, $state->name, $state->code, $state->created_at, $state->updated_at];
                $output.=  "\n".implode(",",$state);
            }
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="state_data_'.time().'.csv"',
        );

        return response()->make(rtrim($output, "\n"), 200, $headers);
    }

    /**
     * Import CSV or Excel file View
     * @return Response
     */
    public function import()
    {
        return view('geo::state.import');
    }

    /**
     * Import CSV or Excel file
     * @return Response
     */
    public function importPost(ImportRequest $request)
    {
        $filePath = $request->file->path();

        $fileds = ['country_id', 'name', 'code'];
        $file = fopen($filePath, "r");

        $i = 1;
        $fieldValue = [];
        $fieldValidation = [];
        $fieldValidationMsg = [];

        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
            if($i == 1){
                $fieldValue['title_name'] = count($getData);
                $fieldValidation['title_name'] = 'required|numeric|min:3|max:3';
                $fieldValidationMsg['title_name.*'] = 'Must be add 3 column in first row of file with Country Name, Name, Code';
            }else{

                // Dynamic Validation for Country Name
                $fieldValue['file'][$i]['country_id'] = isset($getData[0]) && !is_null($country = Country::where('name', $getData[0])->first()) ? $country->id : '';
                $fieldValidation['file.'.$i.'.country_id'] = 'required';
                $fieldValidationMsg['file.'.$i.'.country_id.required'] = 'Row no.'.$i. ' Country field is required and must be added name on country module.';

                // Dynamic Validation for Name
                $fieldValue['file'][$i]['name'] = isset($getData[1]) ? $getData[1] : '';
                $fieldValidation['file.'.$i.'.name'] = 'required|unique:states,name';
                $fieldValidationMsg['file.'.$i.'.name.required'] = 'Row no.'.$i. ' name field is required.';
                $fieldValidationMsg['file.'.$i.'.name.unique'] = 'Row no.'.$i. ' name field is already exist.';

                // Dynamic Validation for Code
                $fieldValue['file'][$i]['code'] = isset($getData[2]) ? $getData[2] : '';
                $fieldValidation['file.'.$i.'.code'] = 'required';
                $fieldValidationMsg['file.'.$i.'.code.required'] = 'Row no.'.$i. ' Code field is required.';

            }
            ++$i;
        }

        $validator = Validator::make($fieldValue, $fieldValidation, $fieldValidationMsg);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($fieldValue['file'] as $state) {
            State::create($state);
        }

        session()->put('success', count($fieldValue['file']).' '.__('admin.general.importMsg'));
        return back();
    }
}
