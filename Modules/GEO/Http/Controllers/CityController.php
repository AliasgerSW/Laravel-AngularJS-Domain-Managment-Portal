<?php

namespace Modules\GEO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GEO\Entities\Country;
use Modules\GEO\Entities\State;
use Modules\GEO\Entities\City;
use Modules\GEO\Http\Requests\CityCreateRequest;
use Modules\GEO\Http\Requests\CityUpdateRequest;
use Modules\GEO\Http\Requests\ImportRequest;
use Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $cities = City::orWhere("name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("code", "LIKE", "%". request()->get('search') ."%")
                ->paginate(10);
        }else{
            $cities = City::paginate(10);
        }
        return view('geo::city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $countriesList = Country::pluck('name', 'id');
        $statesList = State::pluck('name', 'id');
        return view('geo::city.create', compact('countriesList','statesList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CityCreateRequest $request)
    {
        City::create($request->all());
        session()->put('success',__('admin.general.alert.create',['name'=>__('admin.geo.city')]));

        return redirect()->route('cities.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(City $city)
    {
        return view('geo::city.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(City $city)
    {
        $countriesList = Country::pluck('name', 'id');
        $statesList = State::where('country_id',$city->country_id)->pluck('name', 'id');
        return view('geo::city.edit', compact('city','countriesList','statesList'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(City $city, CityUpdateRequest $request)
    {
        $city->update($request->all());
        session()->put('success',__('admin.general.alert.update',['name'=>__('admin.geo.city')]));

        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        session()->put('success',__('admin.general.alert.delete',['name'=>__('admin.geo.city')]));

        return redirect()->route('cities.index');
    }

    /**
     * Export Country Data
     * @return Response CSV
     */
    public function export()
    {
        $cities = City::all();
        $output='Id,Country Name,State Name, Name, Latitude, Longitude, Created At, Updated At';

        if($cities->count() > 0){
            foreach ($cities as $city) {
                $city = [$city->id, $city->country->name, $city->state->name, $city->name, $city->latitude, $city->longitude, $city->created_at, $city->updated_at];
                $output.=  "\n".implode(",",$city);
            }
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="city_data_'.time().'.csv"',
        );

        return response()->make(rtrim($output, "\n"), 200, $headers);
    }

    /**
     * Import CSV or Excel file View
     * @return Response
     */
    public function import()
    {
        return view('geo::city.import');
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
                $country_id = isset($getData[0]) && !is_null($country = Country::where('name', $getData[0])->first()) ? $country->id : '';
                $fieldValue['file'][$i]['country_id'] = $country_id;
                $fieldValidation['file.'.$i.'.country_id'] = 'required';
                $fieldValidationMsg['file.'.$i.'.country_id.required'] = 'Row no.'.$i. ' Country field is required and must be added name on country module.';

                // Dynamic Validation for State Name
                $state_id = isset($getData[1]) && !is_null($state= State::where('name', $getData[1])->where('country_id',$country_id)->first()) ? $state->id : '';
                $fieldValue['file'][$i]['state_id'] = $state_id;
                $fieldValidation['file.'.$i.'.state_id'] = 'required';
                $fieldValidationMsg['file.'.$i.'.state_id.required'] = 'Row no.'.$i. ' State field is required and must be added name on state module.';

                // Dynamic Validation for Name
                $fieldValue['file'][$i]['name'] = isset($getData[2]) ? $getData[2] : '';
                $fieldValidation['file.'.$i.'.name'] = 'required|unique:cities,name';
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

        foreach ($fieldValue['file'] as $city) {
            City::create($city);
        }

        session()->put('success', count($fieldValue['file']).' '.__('admin.general.importMsg'));
        return back();
    }

    public function getCountryIdWithState(Request $request)
    {
        if($request->ajax()){
            $states = State::where('country_id',$request->country_id)->pluck("name","id")->all();
            $data = view('geo::city.ajaxState',compact('states'))->render();
            return response()->json(['options'=>$data]);
        }
    }
}
