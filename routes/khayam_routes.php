<?php

use App\Http\Controllers\admin\BranchController;
use App\Http\Controllers\admin\BusinessController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DropZoneFileController;
use App\Http\Controllers\admin\FuelTypeController;
use App\Http\Controllers\admin\PartnerController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VehicleBodyTypeController;
use App\Http\Controllers\admin\VehicleController;
use App\Http\Controllers\admin\VehicleDriveController;
use App\Http\Controllers\admin\VehicleGroupController;
use App\Http\Controllers\admin\VehicleTransmissionController;
use App\Http\Middleware\BranchScopeMiddleware;
use Illuminate\Support\Facades\Route;

// Authenticated Routes
Route::middleware(['auth', 'sessionData'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // dropzone routes
    Route::post('remove/drop-zone/image', [DropZoneFileController::class, 'removeImage'])->name('dropzone.remove.image');
    Route::post('temporary/file/upload/dropzone/{type}', [DropZoneFileController::class, 'uploadTemporaryImages'])->name('temporary.file.upload.dropzone');

    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::resource('business-settings', BusinessController::class);
        Route::resource('roles', RoleController::class)->except('show');
        Route::get('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::post('users/{user}/reset-password', [UserController::class, 'postResetPassword'])->name('users.post.reset-password');
        Route::resource('users', UserController::class);

        Route::resource('partners', PartnerController::class)->except('show');
        Route::resource('branches', BranchController::class)->except('show');
        Route::resource('vehicle-groups', VehicleGroupController::class)->except('show');
        Route::resource('vehicle-transmissions', VehicleTransmissionController::class)->except('show');
        Route::resource('vehicle-body-types', VehicleBodyTypeController::class)->except('show');
        Route::resource('vehicle-drives', VehicleDriveController::class)->except('show');
        Route::resource('fuel-types', FuelTypeController::class)->except('show');
    });


    Route::prefix('operations')->name('operations.')->group(function () {
        // Vehicle Roues
        Route::prefix('vehicles')->name('vehicles.')->group(function () {
            Route::prefix('validate/step')->name('validate.step.')->group(function () {
                Route::post('one', [VehicleController::class, 'validateStepOne'])->name('one');
                Route::post('one/{id}/edit', [VehicleController::class, 'validateStepOneForEdit'])->name('one.edit');
                Route::post('three', [VehicleController::class, 'validateStepThree'])->name('three');
            });

            Route::get('/', [VehicleController::class, 'index'])->name('index');
            Route::get('create', [VehicleController::class, 'create'])->name('create');
            Route::post('store', [VehicleController::class, 'store'])->name('store');
            Route::get('{vehicle}', [VehicleController::class, 'show'])->name('show');
            Route::get('{vehicle}/edit', [VehicleController::class, 'edit'])->name('edit');
            Route::post('{id}/update', [VehicleController::class, 'update'])->name('update');
            Route::delete('{vehicle}', [VehicleController::class, 'destroy'])->name('destroy');

        });
    });



});
