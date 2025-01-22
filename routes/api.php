<?php

use App\Http\Controllers\Content\ContentController;
use App\Http\Controllers\Enrollment\EnrollmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Semester\SemesterController;
use App\Http\Controllers\Signature\SignatureController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Grade\GradeController;

Route::prefix('v1')->group(function () {
    //Route::middleware('auth:sanctum')->group(function () {
        Route::resource('users', UserController::class)->only([
            'index', 'store', 'show', 'update', 'destroy'
        ]);

        Route::resource('semesters', SemesterController::class)->only([
            'index', 'store', 'show', 'update', 'destroy'
        ]);

        Route::resource('signatures', SignatureController::class)->only([
            'index', 'store', 'show', 'update', 'destroy'
        ]);

        Route::resource('courses', CourseController::class)->only([
            'index', 'store', 'show', 'update', 'destroy'
        ]);

        Route::resource('enrollments', EnrollmentController::class)->only([
            'index', 'store', 'show', 'update', 'destroy'
        ]);

        Route::resource('grades', GradeController::class)->only([
            'index', 'store', 'show', 'update', 'destroy'
        ]);

        Route::resource('contents', ContentController::class)->only([
            'index', 'store', 'show', 'update', 'destroy'
        ]);
    //});

});
