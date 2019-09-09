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

Route::get('/', function () {
    return view('welcome');
});


Route::get('line-member/{uid}', 'LineMemberController@show');
Route::post('line-member', 'LineMemberController@store');

Route::get('/bot/{uid}','BotController@index');
Route::post('/bot/{uid}','BotController@update');

Route::get('/board','SubscribeController@listBoard');

Route::get('/subscribe/{uid}','SubscribeController@index');
Route::post('/subscribe/{uid}','SubscribeController@update');
