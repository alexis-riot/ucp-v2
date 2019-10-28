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
            ->name('profile.password');
    });
    // Punishments
    Route::get('punishments', 'WarnController@index')
        ->name('punishments');
});

Route::group(['prefix' => 'character', 'middleware' => 'IsHisCharacter'], function () {
    // Characters
    Route::get('{id}/{slug}/overview', 'CharacterController@overview')
        ->middleware('IsHisCharacter')
        ->name('character.overview');
    Route::get('{id}/{slug}/settings', 'CharacterController@settings')
        ->middleware('IsHisCharacter')
        ->name('character.settings');
});

Route::prefix('development')->group(function () {
    Route::get('bug/review', 'BugController@review')
        ->name('bug.review');
    Route::resource('bug', 'BugController');
});
