<?php

namespace App\Rules;

use App\Constants\StatusConst;
use Illuminate\Contracts\Validation\Rule;

class Status implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, StatusConst::LIST_STATUS);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be in system status list.';
    }
}
