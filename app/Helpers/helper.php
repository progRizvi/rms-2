<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isRouteActive')) {
    function isRouteActive($patterns): string
    {
        if (Route::is($patterns)) {
            return 'bg-gray-200';
        }

        return '';
    }
}
