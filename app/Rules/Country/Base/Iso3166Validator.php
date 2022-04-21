<?php

namespace App\Rules\Country\Base;

use League\ISO3166\ISO3166;

class Iso3166Validator
{
    public function isValidAlpha3CountryName(string $nameCountry): bool
    {
        return (new ISO3166())->name($nameCountry) !== null;
    }
}
