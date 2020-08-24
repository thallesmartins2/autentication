<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
Route::namespace('Api\v1')->group( function(){
    Route::post('token','AuthController@token');
    Route::get('acessonaoautorizado','AuthController@unauthorizedAccess')->name('acessonaoautorizado');
    Route::resource('autentication','UserController');
});

Route::middleware('auth:api')->namespace('Api\v1')->group( function(){
    Route::get('checktoken','AuthController@authorizedAcess');
    Route::post('logout','AuthController@logout');
});