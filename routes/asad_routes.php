<?php

use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\CustomerStatusController;
use App\Http\Controllers\admin\CustomerTypeController;
use App\Http\Controllers\admin\RentTypeController;
use App\Http\Controllers\admin\VehicleStatusController;
use App\Http\Controllers\admin\VehicleTypeController;
use Illuminate\Support\Facades\Route;

// Customer Routes
Route::middleware(['auth', 'sessionData'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('operations')->name('operations.')->group(function () {
        Route::prefix('customers')->name('customers.')->group(function () {
            // Customer Type Routes
            Route::prefix('type')->name('type.')->group(function () {
                Route::get('/index', [CustomerTypeController::class, 'index'])->name('index');
                Route::get('/show', [CustomerTypeController::class, 'show'])->name('show');
                Route::post('/store', [CustomerTypeController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [CustomerTypeController::class, 'edit'])->name('edit');
                Route::post('/update', [CustomerTypeController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [CustomerTypeController::class, 'delete'])->name('delete');
            });

            // Customer Status Routes
            Route::prefix('status')->name('status.')->group(function () {
                Route::get('/index', [CustomerStatusController::class, 'index'])->name('index');
                Route::get('/show', [CustomerStatusController::class, 'show'])->name('show');
                Route::post('/store', [CustomerStatusController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [CustomerStatusController::class, 'edit'])->name('edit');
                Route::post('/update', [CustomerStatusController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [CustomerStatusController::class, 'delete'])->name('delete');
            });

            // Customer Routes
            Route::get('/index',[CustomerController::class,'index'])->name('index');
            Route::get('/create',[CustomerController::class,'create'])->name('create');
        });
    });



    Route::prefix('settings')->name('settings.')->group(function () {

        // Rent Type Routes
        Route::prefix('rent-type')->name('rent.type.')->group(function () {
            Route::get('/index', [RentTypeController::class, 'index'])->name('index');
            Route::get('/show', [RentTypeController::class, 'show'])->name('show');
            Route::post('/store', [RentTypeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RentTypeController::class, 'edit'])->name('edit');
            Route::post('/update', [RentTypeController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [RentTypeController::class, 'delete'])->name('delete');
        });

        // Vehicle Type Routes
        Route::prefix('vehicle-type')->name('vehicle.type.')->group(function () {
            Route::get('/index', [VehicleTypeController::class, 'index'])->name('index');
            Route::get('/show', [VehicleTypeController::class, 'show'])->name('show');
            Route::post('/store', [VehicleTypeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [VehicleTypeController::class, 'edit'])->name('edit');
            Route::post('/update', [VehicleTypeController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [VehicleTypeController::class, 'delete'])->name('delete');
        });

        // Vehicle Status Routes
        Route::prefix('vehicle-status')->name('vehicle.status.')->group(function () {
            Route::get('/index', [VehicleStatusController::class, 'index'])->name('index');
            Route::get('/show', [VehicleStatusController::class, 'show'])->name('show');
            Route::post('/store', [VehicleStatusController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [VehicleStatusController::class, 'edit'])->name('edit');
            Route::post('/update', [VehicleStatusController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [VehicleStatusController::class, 'delete'])->name('delete');
        });
    });
});

