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
    Route::post('solicitatoken','AuthController@solicitaToken');
    Route::get('acessonaoautorizado','AuthController@acessoNaoAutorizado')->name('acessonaoautorizado');
    Route::resource('autentication','UserController');
});

Route::middleware('auth:api')->namespace('Api\v1')->group( function(){
    Route::get('validatoken','AuthController@acessoAutorizado');
    Route::post('logout','AuthController@logout');
});