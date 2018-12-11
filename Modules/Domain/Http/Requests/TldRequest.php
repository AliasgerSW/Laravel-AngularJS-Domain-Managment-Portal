<?php

namespace Modules\Domain\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TldRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required | ',
            'sequence' => 'required | integer | min:0',
            'feature' => 'required | in:Popular,Regular',
            'is_active_for_sale' => 'required | boolean',
            'registrar' => 'required | in:OpenSRS,ResellerClub,Both',
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
}
