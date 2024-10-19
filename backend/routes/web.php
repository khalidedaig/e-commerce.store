<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        "IP Address" => request()->ip(),
        "Currency" => request()->currency,
        "App Name" => env("APP_NAME"),
        "Server" => env("APP_URL"),
        "Laravel version" => Illuminate\Foundation\Application::VERSION,
        "PHP version" => PHP_VERSION
    ]);
});
