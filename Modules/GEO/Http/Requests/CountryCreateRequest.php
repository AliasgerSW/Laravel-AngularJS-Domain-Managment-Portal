<?php

namespace Modules\GEO\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:countries',
            'iso_alpha_2_code' => 'required|min:2|max:2',
            'iso_alpha_3_code' => 'required|min:2|max:3',
            'iso_numeric_code' => 'required|min:2|max:3',
            'code' => 'required|min:2|max:3',
            'tld' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Validation Messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => __('admin.general.validation.required'),
            '*.unique' => __('admin.general.validation.unique'),
            '*.min' => __('admin.general.validation.min'),
            '*.max' => __('admin.general.validation.max'),
        ];
    }
}
