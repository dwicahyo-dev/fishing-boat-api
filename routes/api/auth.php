<?php

use App\Http\Controllers\Api\Auth\AuthenticatedApiController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Api\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('login', [AuthenticatedApiController::class, 'store']);
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware(['auth:api', 'verified'])
    ->group(function () {
        Route::post('user', function () {
            return auth()->user();
        });
    });

Route::middleware('auth:api')
    ->group(function () {
        // Route::get('verify-email', EmailVerificationPromptController::class)
        //     ->name('verification.notice');

        Route::post('verify-email', VerifyEmailController::class)
            ->middleware(['throttle:6,1'])
            ->name('verification.verify');

        // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        //     ->middleware('throttle:6,1')
        //     ->name('verification.send');

        // Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        //             ->name('logout');
    });
