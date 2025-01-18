<?php

use Illuminate\Support\Facades\Route;

Route::middleware('tenant')->group(function () {
    Route::get('/', function () {
        dd('test');
    });
});
