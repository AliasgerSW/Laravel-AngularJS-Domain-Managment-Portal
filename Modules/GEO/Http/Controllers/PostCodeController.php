<?php

namespace Modules\GEO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GEO\Entities\PostCode;
use Modules\GEO\Entities\City;
use Modules\GEO\Http\Requests\PostCodeCreateRequest;
use Modules\GEO\Http\Requests\PostCodeUpdateRequest;
use Modules\GEO\Http\Requests\ImportRequest;
use Validator;

class PostCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $postCodes = PostCode::orWhere("name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("code", "LIKE", "%". request()->get('search') ."%")
                ->paginate(10);
        }else{
            $postCodes = PostCode::paginate(10);
        }
        return view('geo::postCode.index', compact('postCodes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $cityList = City::pluck('name', 'id');
        return view('geo::postCode.create', compact('cityList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(PostCodeCreateRequest $request)
    {
        PostCode::create($request->all());
        session()->put('success',__('admin.general.alert.create',['name'=>__('admin.geo.postcode')]));

        return redirect()->route('post-code.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(PostCode $postCode)
    {
        return view('geo::postCode.show', compact('postCode'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(PostCode $postCode)
    {
        $cityList = City::pluck('name', 'id');
        return view('geo::postCode.edit', compact('postCode','cityList'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(PostCode $postCode, PostCodeUpdateRequest $request)
    {
        $postCode->update($request->all());
        session()->put('success',__('admin.general.alert.update',['name'=>__('admin.geo.postcode')]));

        return redirect()->route('post-code.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(PostCode $postCode)
    {
        $postCode->delete();
        session()->put('success',__('admin.general.alert.delete',['name'=>__('admin.geo.postcode')]));

        return redirect()->route('post-code.index');
    }

    /**
     * Export Country Data
     * @return Response CSV
     */
    public function export()
    {
        $postCodes = PostCode::all();
        $output='Id,City Name, Code,Created At, Updated At';

        if($postCodes->count() > 0){
            foreach ($postCodes as $postCode) {
                $postCode = [$postCode->id, $postCode->city->name, $postCode->code, $postCode->created_at, $postCode->updated_at];
                $output.=  "\n".implode(",",$postCode);
            }
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="post_code_data_'.time().'.csv"',
        );

        return response()->make(rtrim($output, "\n"), 200, $headers);
    }

    /**
     * Import CSV or Excel file View
     * @return Response
     */
    public function import()
    {
        return view('geo::postCode.import');
    }

    /**
     * Import CSV or Excel file
     * @return Response
     */
    public function importPost(ImportRequest $request)
    {
        $filePath = $request->file->path();

        $fileds = ['city_id', 'code'];
        $file = fopen($filePath, "r");

        $i = 1;
        $fieldValue = [];
        $fieldValidation = [];
        $fieldValidationMsg = [];

        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
            if($i == 1){
                $fieldValue['title_name'] = count($getData);
                $fieldValidation['title_name'] = 'required|numeric|min:2|max:2';
                $fieldValidationMsg['title_name.*'] = 'Must be add 2 column in first row of file with City Name, Code';
            }else{

                // Dynamic Validation for City Name
                $fieldValue['file'][$i]['city_id'] = isset($getData[0]) && !is_null($city = City::where('name', $getData[0])->first()) ? $city->id : '';
                $fieldValidation['file.'.$i.'.city_id'] = 'required';
                $fieldValidationMsg['file.'.$i.'.city_id.required'] = 'Row no.'.$i. ' City field is required and must be added name on city module.';

                // Dynamic Validation for Code
                $fieldValue['file'][$i]['code'] = isset($getData[1]) ? $getData[1] : '';
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

        foreach ($fieldValue['file'] as $postCode) {
            PostCode::create($postCode);
        }

        session()->put('success', count($fieldValue['file']).' '.__('admin.general.importMsg'));
        return back();
    }
}
