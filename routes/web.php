<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DropZoneFileController;
use App\Http\Controllers\GeneralDataController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // fetching general data
    Route::prefix('get/')->name('get.')->group(function () {
       Route::get('semesters/department/{department_id}', [GeneralDataController::class, 'getSemestersWithCoursesByDepartmentId'])->name('semesters.by.department');
    });

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
        Route::resource('sections', SectionController::class)->except(['show']);

    });

    Route::resource('departments', DepartmentController::class);
    Route::resource('courses', CourseController::class);

    Route::prefix('semesters')->name('semesters.')->group(function () {
        Route::get('{semester}/assign/courses', [SemesterController::class, 'assignCoursesView'])->name('assign.courses.view');
        Route::put('{semester}/assign/courses', [SemesterController::class, 'assignCourses'])->name('assign.courses');
    });
    Route::resource('semesters', SemesterController::class);

    // course registration routes
    Route::prefix('course-registrations')->name('course-registrations.')->group(function () {

    });
    Route::resource('course-registrations', CourseRegistrationController::class);
});



