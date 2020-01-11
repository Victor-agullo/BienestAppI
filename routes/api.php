<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
    Route::apiResource('restricts', 'RestrictController');
    Route::post('times', 'UsageController@times');
    Route::post('trace', 'LocationController@trace');
});
