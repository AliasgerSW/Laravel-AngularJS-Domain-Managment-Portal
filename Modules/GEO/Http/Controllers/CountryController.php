<?php

namespace Modules\GEO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GEO\Entities\Country;
use Modules\GEO\Entities\Language;
use Modules\GEO\Entities\CountryLanguage;
use Modules\GEO\Http\Requests\CountryCreateRequest;
use Modules\GEO\Http\Requests\CountryUpdateRequest;
use Modules\GEO\Http\Requests\ImportRequest;
use Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $countries = Country::orWhere("name", "LIKE", "%". request()->get('search') ."%")
                            ->orWhere("iso_alpha_2_code", "LIKE", "%". request()->get('search') ."%")
                            ->orWhere("iso_alpha_3_code", "LIKE", "%". request()->get('search') ."%")
                            ->orWhere("iso_numeric_code", "LIKE", "%". request()->get('search') ."%")
                            ->orWhere("code", "LIKE", "%". request()->get('search') ."%")
                            ->orWhere("tld", "LIKE", "%". request()->get('search') ."%")
                            ->paginate(10);
        }else{
            $countries = Country::paginate(10);
        }
        return view('geo::country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $languagesList = Language::pluck('name','id');
        return view('geo::country.create',compact('languagesList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CountryCreateRequest $request)
    {
        $country = Country::create($request->all());
        if(!empty($request->language_id)){
            foreach ($request->language_id as $item) {
                CountryLanguage::create(['language_id'=>$item, 'country_id'=>$country->id]);
            }
        }
        session()->put('success',__('admin.general.alert.create',['name'=>__('admin.geo.country')]));

        return redirect()->route('countries.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Country $country)
    {
        return view('geo::country.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Country $country)
    {
        return view('geo::country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Country $country, CountryUpdateRequest $request)
    {
        $country->update($request->all());
        session()->put('success',__('admin.general.alert.update',['name'=>__('admin.geo.country')]));

        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        session()->put('success',__('admin.general.alert.delete',['name'=>__('admin.geo.country')]));

        return redirect()->route('countries.index');
    }

    /**
     * Export Country Data
     * @return Response CSV
     */
    public function export()
    {
        $countries = Country::all();
        $output='Id,Name,ISO Alpha Code 2,ISO Alpha Code 3,ISO Numeric Code,Code,TLD,Created At, Updated At';

        if($countries->count() > 0){
            foreach ($countries as $country) {
                $output.=  "\n".implode(",",$country->toArray());
            }
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="country_data_'.time().'.csv"',
        );

        return response()->make(rtrim($output, "\n"), 200, $headers);
    }

    /**
     * Import CSV or Excel file View
     * @return Response
     */
    public function import()
    {
        return view('geo::country.import');
    }

    /**
     * Import CSV or Excel file
     * @return Response
     */
    public function importPost(ImportRequest $request)
    {
        $filePath = $request->file->path();

        $fileds = ['name', 'iso_alpha_2_code', 'iso_alpha_3_code', 'iso_numeric_code', 'code', 'tld'];
        $file = fopen($filePath, "r");

        $i = 1;
        $fieldValue = [];
        $fieldValidation = [];
        $fieldValidationMsg = [];

        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
            if($i == 1){
                $fieldValue['title_name'] = count($getData);
                $fieldValidation['title_name'] = 'required|numeric|min:6|max:6';
                $fieldValidationMsg['title_name.*'] = 'Must be add 6 column in first row of file with Name, ISO Alpha 2 Code, ISO Alpha 3 Code, ISO Numeric Code, Code, TLD names';
            }else{
                // Dynamic Validation for Name
                $fieldValue['file'][$i]['name'] = isset($getData[0]) ? $getData[0] : '';
                $fieldValidation['file.'.$i.'.name'] = 'required|unique:countries,name';
                $fieldValidationMsg['file.'.$i.'.name.required'] = 'Row no.'.$i. ' name field is required.';
                $fieldValidationMsg['file.'.$i.'.name.unique'] = 'Row no.'.$i. ' name field is already exist.';

                // Dynamic Validation for ISO Alpha 2 Code
                $fieldValue['file'][$i]['iso_alpha_2_code'] = isset($getData[1]) ? $getData[1] : '';
                $fieldValidation['file.'.$i.'.iso_alpha_2_code'] = 'required';
                $fieldValidationMsg['file.'.$i.'.iso_alpha_2_code.required'] = 'Row no.'.$i. ' ISO Alpha 2 Code field is required.';

                // Dynamic Validation for ISO Alpha 3 Code
                $fieldValue['file'][$i]['iso_alpha_3_code'] = isset($getData[2]) ? $getData[2] : '';
                $fieldValidation['file.'.$i.'.iso_alpha_3_code'] = 'required';
                $fieldValidationMsg['file.'.$i.'.iso_alpha_3_code.required'] = 'Row no.'.$i. ' ISO Alpha 3 Code field is required.';

                // Dynamic Validation for ISO Numeric Code
                $fieldValue['file'][$i]['iso_numeric_code'] = isset($getData[3]) ? $getData[3] : '';
                $fieldValidation['file.'.$i.'.iso_numeric_code'] = 'required';
                $fieldValidationMsg['file.'.$i.'.iso_numeric_code.required'] = 'Row no.'.$i. ' ISO Numeric Code field is required.';

                // Dynamic Validation for Code
                $fieldValue['file'][$i]['code'] = isset($getData[4]) ? $getData[4] : '';
                $fieldValidation['file.'.$i.'.code'] = 'required';
                $fieldValidationMsg['file.'.$i.'.code.required'] = 'Row no.'.$i. ' Code field is required.';

                // Dynamic Validation for TLD
                $fieldValue['file'][$i]['tld'] = isset($getData[4]) ? $getData[4] : '';
                $fieldValidation['file.'.$i.'.tld'] = 'required';
                $fieldValidationMsg['file.'.$i.'.tld.required'] = 'Row no.'.$i. ' TLD field is required.';
            }
            ++$i;
        }

        $validator = Validator::make($fieldValue, $fieldValidation, $fieldValidationMsg);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($fieldValue['file'] as $country) {
            Country::create($country);
        }

        session()->put('success', count($fieldValue['file']).' '.__('admin.general.importMsg'));
        return back();
    }
}
