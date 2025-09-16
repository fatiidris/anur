<?php

if (!function_exists('ordinal')) {
    function ordinal($number)
    {
        // Convert to integer (avoid non-numeric errors)
        $number = intval($number);

        if ($number <= 0) {
            return '-'; // return dash instead of 0
        }

        $ends = ['th','st','nd','rd','th','th','th','th','th','th'];

        if (($number % 100) >= 11 && ($number % 100) <= 13) {
            return $number . 'th';
        }

        return $number . $ends[$number % 10];
    }
}
