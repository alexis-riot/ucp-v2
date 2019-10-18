<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentification
Auth::routes([
    'register' => false, // Registration Routes...
    'login' => true, // Login Routes...
    'reset' => true, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'email' => false, // Email Verification Routes...
    'confirm' => false, // Confirm Verification Routes...
]);

// Index page
Route::get('/', 'IndexController')
    ->name('home');

Route::prefix('master')->group(function () {
    Route::prefix('user')->group(function () {
        // User profile
        Route::get('profile', 'UserController@index')
            ->name('profile');
        Route::get('profile/password', 'UserController@password')
            ->name('profile/password');
    });
    // Punishments
    Route::get('punishments', 'WarnController@index')
        ->name('punishments');
});

Route::prefix('character')->group(function () {
    // Characters
    Route::get('{id}/{slug}', 'CharacterController@show')
        ->middleware('IsHisCharacter')
        ->name('character');
});
