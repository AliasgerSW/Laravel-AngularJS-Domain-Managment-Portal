<?php

namespace Modules\GEO\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:states,name,'.$this->segment(4),
            'code' => 'required',
            'country_id' => 'required',
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
        ];
    }
}
