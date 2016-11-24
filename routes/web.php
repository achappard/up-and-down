<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

// Authentification route
Route::get('login',  'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

// Disable registration to enable, un comment this rwo lines
//Route::get('register', 'Auth\RegisterController@showRegistrationForm');
//Route::post('register', 'Auth\RegisterController@register');


//Route::resource('titi', 'Admin\BackgroundManagement');


// Admin dashboard
Route::get('admin', 'Admin\DashboardController@index')->name('dashboard.index');



Route::group(['prefix' => 'admin'], function () {
    Route::get('background-management', 'Admin\BackgroundManagement@index')->name('background.index');
    Route::post('background-management', 'Admin\BackgroundManagement@store')->name('background.store');
    Route::delete('background-management/{background}', 'Admin\BackgroundManagement@destroy')->name('background.destroy');

    Route::get('my-profile', 'Admin\UserProfilController@show')->name('userprofile.show');
    Route::put('my-profile/{userprofile}', 'Admin\UserProfilController@update')->name('userprofile.update');
});