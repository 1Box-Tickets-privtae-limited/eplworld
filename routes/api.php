<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('setting','App\Http\Controllers\Api\ApiController@setting');
Route::get('country','App\Http\Controllers\Api\ApiController@country');
Route::post('state','App\Http\Controllers\Api\ApiController@state');


Route::get('get_teams','App\Http\Controllers\Api\ApiController@get_teams');
Route::get('get_games','App\Http\Controllers\Api\ApiController@get_games');
Route::get('get_stadium','App\Http\Controllers\Api\ApiController@get_stadium');
Route::get('get_tournament','App\Http\Controllers\Api\ApiController@get_tournament');


Route::post('login','App\Http\Controllers\Api\ApiController@login');
Route::post('register','App\Http\Controllers\Api\ApiController@register');

//PROFILE
Route::get('get_profile','App\Http\Controllers\Api\ApiController@get_profile');
Route::post('update_profile','App\Http\Controllers\Api\ApiController@update_profile');
Route::post('update_account','App\Http\Controllers\Api\ApiController@update_account');
Route::post('change_password','App\Http\Controllers\Api\ApiController@change_password');
Route::get('get_address','App\Http\Controllers\Api\ApiController@get_address');
Route::post('add_address','App\Http\Controllers\Api\ApiController@add_address');
Route::post('edit_address','App\Http\Controllers\Api\ApiController@edit_address');
Route::post('delete_address','App\Http\Controllers\Api\ApiController@delete_address');


//Route::post('/login', 'Api',[ApiController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
