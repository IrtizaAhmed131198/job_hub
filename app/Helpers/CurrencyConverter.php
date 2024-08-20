<?php

namespace App\Helpers;

use App\Models\Settings;

class CurrencyConverter
{
    public static function convertUsdToKes($amount)
    {
        $rate = Settings::latest()->first()->rate ?? 1;
        return $amount * $rate;
    }
}
