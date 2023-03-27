<?php

use Illuminate\Support\Facades\Route;


// Non Authenticated Routes
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

});






require __DIR__.'/auth.php';
