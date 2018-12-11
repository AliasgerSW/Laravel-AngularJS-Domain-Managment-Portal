<?php

namespace Modules\GEO\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\GEO\Rules\CheckKeyIsExist;

class TranslationCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'language_id' => 'required',
            'key' => ['required', new CheckKeyIsExist],
            'value' => 'required',
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
        ];
    }
}
