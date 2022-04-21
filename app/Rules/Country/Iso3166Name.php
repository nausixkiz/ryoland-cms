<?php

namespace App\Rules;

use Jekk0\laravel\Iso3166\Validation\Rules\Classes\Iso3166BaseRule;

class Iso3166Name extends Iso3166BaseRule
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
        return $this->validator->isValidAlpha3CountryName((string)$value);
    }
}
