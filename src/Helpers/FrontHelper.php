<?php

namespace App\Helpers;

namespace Stegback\RetailShop\Helpers;

class FrontHelper
{
    function price($price, $currency_symbol = null)
    {
        if (!empty(@$currency_symbol)) {
            $p = $currency_symbol . '' . number_format((float)$price, 2, ',', '.');
            return $p;
        } else {
            $p = '€' . number_format((float)$price, 2, ',', '.');
            return $p;
        }
    }
}
