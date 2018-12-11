<?php

namespace Modules\GEO\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckKeyIsExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $jsonString = file_get_contents(base_path('resources/lang/en.json'));
        $data = json_decode($jsonString, true);

        if(isset($data[$value])){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The key is already exist.';
    }
}
