<?php

namespace Modules\Domain\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TldOtherRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'min_purchase_limit' => 'integer | between:1,10',
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
