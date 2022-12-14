<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\user\MyProfileController;
use App\Http\Controllers\user\api\UserApiController;
use App\Http\Controllers\posts\CreatePostController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');


    Route::get('/user/my-profile',[MyProfileController::class, 'get'])
        ->middleware(['auth', 'verified'])->name('myprofile');

    //api-s user vievs
    Route::get('/user/api',[UserApiController::class, 'get'])
        ->middleware(['auth', 'verified'])->name('userapi');

    Route::post('/user/api/add',[UserApiController::class, 'add_api'])
        ->middleware(['auth', 'verified'])->name('userapiadd');

    Route::post('/user/api/delete',[UserApiController::class, 'delete_api'])
        ->middleware(['auth', 'verified'])->name('userapidelete');
    //----

    //??????????
    Route::get('/posts/create', [CreatePostController::class, 'get'])
        ->middleware(['auth', 'verified'])->name('postcreate');
    Route::post('/posts/create/add', [CreatePostController::class, 'add'])
        ->middleware(['auth', 'verified'])->name('postcreateadd');
    //----
});
