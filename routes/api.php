<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Semester\SemesterController;
use App\Http\Controllers\Signature\SignatureController;


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
    //});

});
