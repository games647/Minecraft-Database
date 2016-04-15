<?php

/* Simple configuration file for Laravel Sitemap package */
return [
    'use_cache' => !env('APP_DEBUG', false),
    'cache_key' => 'laravel-sitemap.' . config('app.url'),
    'cache_duration' => 30,
    'escaping' => true,
    'use_limit_size' => false,
    'max_size' => null,
    'use_styles' => false,
    'styles_location' => '/css/sitemap/',
//    use this to no longer generate assets
    'testing' => true,
];
