<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['tenant'])->group(function () {
    Route::get('/', function () {
        return 'Welcome to the tenant!';
    });

    // Add other tenant-specific routes here
});
