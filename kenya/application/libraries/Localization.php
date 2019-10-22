<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localization
{
    public function currencyFormat($currency, $currency_format = null)
    {
        if(!empty($currency_format)){

            if($currency_format == 1){
                return number_format($currency, 2, '.', '');
            }
            elseif($currency_format == 2)
            {
                return number_format($currency, 2, '.', ',');
            }
            elseif($currency_format == 3)
            {
                return number_format($currency, 2, ',', '');
            }
            elseif($currency_format == 4)
            {
                return number_format($currency, 2, ',', '.');
            }else{
                return number_format($currency);
            }

        }else{
            return number_format($currency, 2, '.', ',');
        }
    }


    public function dateFormat($date = null, $format = 'd/m/Y')
    {
        return date($format, strtotime($date));
    }
}