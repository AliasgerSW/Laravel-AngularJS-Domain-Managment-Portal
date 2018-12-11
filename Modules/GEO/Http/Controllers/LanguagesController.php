<?php

namespace Modules\GEO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GEO\Entities\Language;
use Modules\GEO\Http\Requests\LanguageCreateRequest;
use Modules\GEO\Http\Requests\LanguageUpdateRequest;
use Modules\GEO\Http\Requests\ImportRequest;
use Validator;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(request()->get('search')){
            $languages = Language::orWhere("name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("name", "LIKE", "%". request()->get('search') ."%")
                ->orWhere("code", "LIKE", "%". request()->get('search') ."%")
                ->paginate(10);
        }else{
            $languages = Language::paginate(10);
        }
        return view('geo::language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('geo::language.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(LanguageCreateRequest $request)
    {
        $input = $request->all();
        $input['is_translate'] = isset($input['is_translate']) ? 1 : 0;
        Language::create($input);
        session()->put('success',__('admin.general.alert.create',['name'=>__('admin.geo.language')]));

        return redirect()->route('languages.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Language $language)
    {
        return view('geo::language.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Language $language)
    {
        return view('geo::language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Language $language, LanguageUpdateRequest $request)
    {
        $input = $request->all();
        $input['is_translate'] = isset($input['is_translate']) ? 1 : 0;
        $language->update($input);
        session()->put('success',__('admin.general.alert.update',['name'=>__('admin.geo.language')]));

        return redirect()->route('languages.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Language $language)
    {
        $language->delete();
        session()->put('success',__('admin.general.alert.delete',['name'=>__('admin.geo.language')]));

        return redirect()->route('languages.index');
    }

    /**
     * Export Country Data
     * @return Response CSV
     */
    public function export()
    {
        $languages = Language::all();
        $output='Id, Name(English), Name, Code, Script Type, Language Family, Language Type, Language ISO Type, Created At, Updated At';

        if($languages->count() > 0){
            foreach ($languages as $language) {
                $postCode = [$language->id, $language->name_english, $language->name, $language->code, $language->script_type, $language->family, $language->type, $language->type_iso_code, $language->created_at, $language->updated_at];
                $output.=  "\n".implode(",",$postCode);
            }
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="language_data_'.time().'.csv"',
        );

        return response()->make(rtrim($output, "\n"), 200, $headers);
    }

    /**
     * Import CSV or Excel file View
     * @return Response
     */
    public function import()
    {
        return view('geo::language.import');
    }

    /**
     * Import CSV or Excel file
     * @return Response
     */
    public function importPost(ImportRequest $request)
    {
        $filePath = $request->file->path();

        $fileds = ['name', 'code'];
        $file = fopen($filePath, "r");

        $i = 1;
        $fieldValue = [];
        $fieldValidation = [];
        $fieldValidationMsg = [];

        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
            if($i == 1){
                $fieldValue['title_name'] = count($getData);
                $fieldValidation['title_name'] = 'required|numeric|min:3|max:7';
                $fieldValidationMsg['title_name.*'] = 'Must be add 7 column in first row of file with Name(English), Name, Code, Script Type, Language Family, Language Type, Language ISO Type.';
            }else{
                // Dynamic Validation for English Name
                $fieldValue['file'][$i]['name_english'] = isset($getData[0]) ? $getData[0] : '';
                $fieldValidation['file.'.$i.'.name_english'] = 'required|unique:languages,name_english';
                $fieldValidationMsg['file.'.$i.'.name_english.required'] = 'Row no.'.$i. ' name field is required.';
                $fieldValidationMsg['file.'.$i.'.name_english.unique'] = 'Row no.'.$i. ' name_english field is already exist.';

                // Dynamic Validation for Name
                $fieldValue['file'][$i]['name'] = isset($getData[1]) ? $getData[1] : '';
                $fieldValidation['file.'.$i.'.name'] = 'required';
                $fieldValidationMsg['file.'.$i.'.name.required'] = 'Row no.'.$i. ' name field is required.';
                $fieldValidationMsg['file.'.$i.'.name.unique'] = 'Row no.'.$i. ' name_english field is already exist.';

                // Dynamic Validation for Code
                $fieldValue['file'][$i]['code'] = isset($getData[2]) ? $getData[2] : '';
                $fieldValidation['file.'.$i.'.code'] = 'required|unique:languages,code';
                $fieldValidationMsg['file.'.$i.'.code.required'] = 'Row no.'.$i. ' Code field is required.';
                $fieldValidationMsg['file.'.$i.'.code.unique'] = 'Row no.'.$i. ' code field is already exist.';

                // Dynamic Validation for Script Type
                if(isset($getData[3])){
                    $fieldValue['file'][$i]['script_type'] = $getData[3];
                }

                // Dynamic Validation for Language Family
                if(isset($getData[4])){
                    $fieldValue['file'][$i]['family'] = $getData[4];
                }

                // Dynamic Validation for Language Family
                if(isset($getData[5])){
                    $fieldValue['file'][$i]['type'] = $getData[5];
                }

                // Dynamic Validation for Language Family
                if(isset($getData[6])){
                    $fieldValue['file'][$i]['type_iso_code'] = $getData[6];
                }

            }
            ++$i;
        }

        $validator = Validator::make($fieldValue, $fieldValidation, $fieldValidationMsg);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($fieldValue['file'] as $language) {
            Language::create($language);
        }

        session()->put('success', count($fieldValue['file']).' '.__('admin.general.importMsg'));
        return back();
    }
}
