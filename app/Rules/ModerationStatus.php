<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ModerationStatus implements Rule
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
        return in_array($value, \App\Constants\ModerationStatus::getAllListModerationStatus());
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
