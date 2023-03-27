<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DropZoneFileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // dropzone routes
    Route::post('remove/drop-zone/image', [DropZoneFileController::class, 'removeImage'])->name('dropzone.remove.image');
    Route::post('temporary/file/upload/dropzone/{type}', [DropZoneFileController::class, 'uploadTemporaryImages'])->name('temporary.file.upload.dropzone');

    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::resource('roles', RoleController::class)->except('show');
        Route::get('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::post('users/{user}/reset-password', [UserController::class, 'postResetPassword'])->name('users.post.reset-password');
        Route::resource('users', UserController::class);

    });

});



