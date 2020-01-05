<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::post('forgot', 'UserController@passRecovery');

Route::group(['middleware' => ['auth']], function () {
    Route::apiResource('users', 'UserController');
    Route::apiResource('applications', 'ApplicationController');
    Route::apiResource('restricts', 'RestrictController');
    Route::apiResource('stores', 'StoreController');
    Route::apiResource('usages', 'UsageController');
    Route::post('times', 'UsageController@times');
});
