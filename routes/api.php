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

Route::get('/register', 'LineMemberController@register');
Route::get('/callback', 'LineMemberController@callback');

Route::middleware('jwt.auth','register')->group(function () {
    Route::get('/ptt-account','PttAccountController@index');
    Route::post('/ptt-account','PttAccountController@update');

    Route::get('/board','SubscribeController@listBoard');

    Route::get('/subscribe','SubscribeController@index');
    Route::post('/subscribe','SubscribeController@update');

    Route::get('/notify/register','NotifyController@register');
    Route::get('/notify/callback','NotifyController@callback');
});