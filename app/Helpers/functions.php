<?php

use App\Models\Configuracoes;
use App\Models\Igreja;
use Illuminate\Support\Facades\Auth;

function empresa()
{
    return Auth::user()->empresa;
}


function getMoney($value, $moeda = null)
{
    if ($value === null) {
        return '0,00';
    }
    if ($moeda !== null) {
        return $moeda . " " . number_format($value, 2, ',', '.');
    } else {
        return @number_format($value, 2, ',', '.');
    }
}
if (!function_exists('saveMoney')) {
    function saveMoney($value)
    {

        if ($value === null) {
            return 0.00;
        }
        $money = str_replace(".", "", $value);
        $money = str_replace(",", ".", $money);
        return $money;
    }
}
