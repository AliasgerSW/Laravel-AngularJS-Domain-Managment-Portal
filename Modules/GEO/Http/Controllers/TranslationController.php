<?php

namespace Modules\GEO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GEO\Entities\Language;
use Modules\GEO\Http\Requests\TranslationCreateRequest;
use Modules\GEO\Http\Requests\LanguageUpdateRequest;
use Modules\GEO\Http\Requests\ImportTranslationRequest;
use Validator;
use File;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $languages = Language::isTranslate()->get();

        $columns = [];
        $columnsCount = $languages->count();
        if($languages->count() > 0){
            foreach ($languages as $key => $language){
                if ($key == 0) {
                    $columns[$key] = $this->openJSONFile($language->code);
                }
                $columns[++$key] = ['data'=>$this->openJSONFile($language->code), 'lang'=>$language->code];
            }
        }

        return view('geo::translation.index', compact('languages','columns','columnsCount'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $languageList = Language::pluck('name_english', 'code');
        return view('geo::translation.create', compact('languageList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(TranslationCreateRequest $request)
    {
        $data = $this->openJSONFile($request->language_id);
        $data[$request->key] = $request->value;

        $this->saveJSONFile($request->language_id, $data);
        session()->put('success',__('admin.general.alert.create',['name'=>__('admin.geo.translation')]));

        return redirect()->route('translations.index');
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
        $language->update($request->all());
        session()->put('success',__('admin.general.alert.update',['name'=>__('admin.geo.translation')]));

        return redirect()->route('languages.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($key)
    {
        $languages = Language::isTranslate()->get();

        if($languages->count() > 0){
            foreach ($languages as $language){
                $data = $this->openJSONFile($language->code);
                unset($data[$key]);
                $this->saveJSONFile($language->code, $data);
            }
        }

        return response()->json(['success' => $key]);
    }

    /**
     * Export Country Data
     * @return Response CSV
     */
    public function export()
    {
        $languages = Language::isTranslate()->get();
        $output='Key,';

        $columns = [];
        if($languages->count() > 0){
            foreach ($languages as $key => $language){
                $output.= $language->name.",";
                if ($key == 0) {
                    $columns[$key] = $this->openJSONFile($language->code);
                }
                $columns[++$key] = ['data'=>$this->openJSONFile($language->code), 'lang'=>$language->code];
            }

            foreach ($columns[0] as $columnKey => $columnValue){
                $row= $columnKey;
                for ($i=1; $i<=$languages->count(); ++$i){
                    $row.= ",";
                    $row.= isset($columns[$i]['data'][$columnKey]) ? $columns[$i]['data'][$columnKey] : '';
                }
                $output.=  "\n".$row;
            }
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="translation_data_'.time().'.csv"',
        );

        return response()->make(rtrim($output, "\n"), 200, $headers);
    }

    /**
     * Import CSV or Excel file View
     * @return Response
     */
    public function import()
    {
        $languageList = Language::isTranslate()->pluck('name_english', 'code');
        return view('geo::translation.import',compact('languageList'));
    }

    /**
     * Import CSV or Excel file
     * @return Response
     */
    public function importPost(ImportTranslationRequest $request)
    {
        $filePath = $request->file->path();

        $fileds = ['key', 'value'];
        $file = fopen($filePath, "r");

        $i = 1;
        $fieldValue = [];
        $fieldValidation = [];
        $fieldValidationMsg = [];

        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
            if($i == 1){
                $fieldValue['title_name'] = count($getData);
                $fieldValidation['title_name'] = 'required|numeric|min:2|max:2';
                $fieldValidationMsg['title_name.*'] = 'Must be add 2 column in first row of file with Key and Value';
            }else{
                // Key Field
                $fieldValue['file'][$i]['key'] = isset($getData[0]) ? $getData[0] : '';
                $fieldValidation['file.'.$i.'.key'] = 'required';
                $fieldValidationMsg['file.'.$i.'.key.required'] = 'Row no.'.$i. ' key field is required.';

                // Value Field
                $fieldValue['file'][$i]['value'] = isset($getData[1]) ? $getData[1] : '';
                $fieldValidation['file.'.$i.'.value'] = 'required';
                $fieldValidationMsg['file.'.$i.'.value.required'] = 'Row no.'.$i. ' value field is required.';
            }
            ++$i;
        }

        $validator = Validator::make($fieldValue, $fieldValidation, $fieldValidationMsg);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $this->openJSONFile($request->language_id);
        foreach ($fieldValue['file'] as $translate) {
            $data[$translate['key']] = $translate['value'];
        }
        $this->saveJSONFile($request->language_id, $data);

        session()->put('success', count($fieldValue['file']).' '.__('admin.general.importMsg'));
        return back();
    }

    /**
     * Open Translation File
     * @return Response
     */
    private function openJSONFile($code){
        $jsonString = [];
        if(File::exists(base_path('resources/lang/'.$code.'.json'))){
            $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }

    /**
     * Save JSON File
     * @return Response
     */
    private function saveJSONFile($code, $data){
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
    }

    /**
     * Save JSON File
     * @return Response
     */
    public function transUpdate(Request $request){
        $data = $this->openJSONFile($request->code);
        $data[$request->pk] = $request->value;

        $this->saveJSONFile($request->code, $data);
        return response()->json(['success'=>'Done!']);
    }

    public function transUpdateKey(Request $request){
        $languages = Language::isTranslate()->get();

        if($languages->count() > 0){
            foreach ($languages as $language){
                $data = $this->openJSONFile($language->code);
                if (isset($data[$request->pk])){
                    $data[$request->value] = $data[$request->pk];
                    unset($data[$request->pk]);
                    $this->saveJSONFile($language->code, $data);
                }
            }
        }

        return response()->json(['success'=>'Done!']);
    }
}
