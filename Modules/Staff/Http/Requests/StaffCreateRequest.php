<?php

namespace Modules\Staff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffCreateRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:30',
            'middle_name' => 'max:30',
            'last_name' => 'min:2|max:30',
            'gender' => 'required',
            'email' => 'required|email|unique:staff,email',
            'p_email' => 'sometimes|nullable|email',
            'user_level' => 'required',
            'staff_position_id' => 'required',
            'username' => 'required|unique:staff,username',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'zipcode' => 'required',
            'address1' => 'required',
            'phone1' => 'required',
            'display_name' => 'required',
            'address_proof_id' => 'required',
            'address_proof_number' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document' => 'required|file|mimes:pdf,jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
