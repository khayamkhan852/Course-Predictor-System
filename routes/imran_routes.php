<?php

use Illuminate\Support\Facades\Route;

// Authenticated Routes
Route::middleware(['auth', 'sessionData'])->prefix('admin')->name('admin.')->group(function () {

});
