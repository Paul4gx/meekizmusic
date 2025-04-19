<?php

use App\Models\AdminSetting;
use App\Models\Genre;

if (!function_exists('currency_symbol')) {
    function currency_symbol()
    {
        try {
            $symbol = cache()->rememberForever('admin_currency_symbol', function () {
                $setting = AdminSetting::first();
                return $setting && $setting->currency_symbol ? $setting->currency_symbol : '₦';
            });

            return $symbol;
        } catch (\Exception $e) {
            return '₦'; // Default fallback
        }
    }
}

if (!function_exists('allgenres')) {
    function allgenres()
    {
        try {
            $genres = Genre::all();

            if ($genres->isEmpty()) {
                // Return a default genre as an array or Collection
                return collect([
                    (object)[
                        'name' => 'Afrobeat',
                        'slug' => 'afrobeat'
                    ]
                ]);
            }

            return $genres;
        } catch (\Exception $e) {
            return collect([
                (object)[
                    'name' => 'Afrobeat',
                    'slug' => 'afrobeat'
                ]
            ]);
        }
    }
}



