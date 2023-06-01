<?php

use Carbon\Carbon;

if (! function_exists('setDateFormat')) {
    function setDateFormat($date) {
        return Carbon::parse($date)->format('d M, y');
    }
}
