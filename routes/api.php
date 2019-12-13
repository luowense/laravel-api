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

Use App\Message;


Route::group(['middleware' => 'auth:api'], function(){
    Route::get('messages', 'BaseController@index');
    Route::get('messages/{message}', 'BaseController@show');
    Route::post('messages', 'BaseController@store');
    Route::put('messages/{message}', 'BaseController@update');
    Route::delete('messages/{message}', 'BaseController@delete');
});


Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::middleware('auth:api')
    ->get('/user', function(Request $request) {
       return $request->user();
    });

Auth::guard('api')->user();
Auth::guard('api')->check();
Auth::guard('api')->id();

