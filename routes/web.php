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

Route::get('/subscribe','SubscribeController@index');

Route::get('line-member/{uid}', 'LineMemberController@show');
Route::post('line-member', 'LineMemberController@store');

Route::get('/test',function(){
    $collect = collect([1,2,3]);

    $result = $collect->search(1);

    var_dump();

});