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

Route::get('getAllUsers',"UserController@getAllUsers");

Route::get('/', "UserController@index");
Route::post("/","UserController@store");

Route::put('editUserInfo',"UserController@editUserInfo");

Route::get('getUserInfo','UserController@getUserInfo');

Route::delete('deleteUser',"UserController@deleteUser");

Route::post("search","UserController@search");

