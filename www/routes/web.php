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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


// Auth
Route::get('/auth/twitter/login', 'Auth\SocialController@getTwitterAuth');
Route::get('/auth/twitter/callback', 'Auth\SocialController@getTwitterAuthCallback');

Route::get('/auth/facebook/login', 'Auth\SocialController@getFacebookAuth');
Route::get('/auth/facebook/callback', 'Auth\SocialController@getFacebookAuthCallback');

Route::get('/auth/google/login', 'Auth\SocialController@getGoogleAuth');
Route::get('/auth/google/callback', 'Auth\SocialController@getGoogleAuthCallback');

Route::get('/auth/instagram/login', 'Auth\SocialController@getInstagramAuth');
Route::get('/auth/instagram/callback', 'Auth\SocialController@getInstagramAuthCallback');


// System admin
Route::group(['prefix' => 'va-admin', 'middleware' => 'guest:admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
    Route::post('/login', 'AdminAuth\LoginController@login');
});

Route::group(['prefix' => 'va-admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/logout', 'AdminAuth\LoginController@logout');

    Route::get('/', function () {
        return view('admin.index');
    });
});
