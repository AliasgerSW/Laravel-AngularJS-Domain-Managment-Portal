<?php

namespace Modules\Domain\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainContactDetailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required',
            'domain_id' => 'required',
            'type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'org_name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required'
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
