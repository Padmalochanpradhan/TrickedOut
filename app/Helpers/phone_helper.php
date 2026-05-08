<?php

if (!function_exists('format_phone')) {
    function format_phone($phone)
    {
        $digits = preg_replace('/\D/', '', $phone);
        $digits = substr($digits, -10);

        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $digits);
    }
}
