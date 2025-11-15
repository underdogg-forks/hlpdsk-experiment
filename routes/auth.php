<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Routes for user authentication including login, registration, password
| reset, and social authentication.
|
*/

Route::middleware('web')->group(function () {
    Route::middleware('install', 'update')->group(function () {
        \Illuminate\Support\Facades\Auth::routes();
        Route::post('login', [Auth\AuthController::class, 'postLogin'])->name('post.login');
        Route::post('auth/register', [Auth\AuthController::class, 'postRegister'])->name('post.register');
        Route::post('password/reset', [Auth\PasswordController::class, 'reset'])->name('post.reset');
        Route::get('auth/logout', [Auth\AuthController::class, 'getLogout'])->name('get.logout');
        Route::get('social/login/redirect/{provider}/{redirect?}', [Auth\AuthController::class, 'redirectToProvider'])->name('social.login');
        Route::get('social/login/{provider}', [Auth\AuthController::class, 'handleProviderCallback'])->name('social.login.callback');
    });

    Route::get('password/email/{one?}/{two?}/{three?}/{four?}/{five?}', [Auth\PasswordController::class, 'getEmail'])->name('password.email');
    Route::get('auth/register/{one?}/{two?}/{three?}/{four?}/{five?}', [Auth\AuthController::class, 'getRegister'])->name('auth.register');
    Route::get('auth/login/{one?}/{two?}/{three?}/{four?}/{five?}', [Auth\AuthController::class, 'getLogin'])->name('auth.login');
    Route::post('auth/login', [Auth\AuthController::class, 'postLogin'])->name('auth.post.login');
    Route::get('account/activate/{token}', [Auth\AuthController::class, 'accountActivate'])->name('account.activate');
    Route::get('getmail/{token}', [Auth\AuthController::class, 'getMail']);
    Route::get('verify-otp', [Auth\AuthController::class, 'getVerifyOTP'])->name('otp-verification');
    Route::post('verify-otp', [Auth\AuthController::class, 'verifyOTP'])->name('otp-verification');
    Route::post('resend/opt', [Auth\AuthController::class, 'resendOTP'])->name('resend-otp');
});
