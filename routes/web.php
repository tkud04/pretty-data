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

Route::get('/', 'MainController@getIndex');
Route::get('send', 'MainController@getBomb');
Route::get('email-extractor', 'MainController@getEmExt');
Route::get('emext-result', 'MainController@getEmExtResult');

Route::get('emext-signin', 'OAuthController@getLogin');
#Route::get('emext-authorize', 'OAuthController@getAuthorize');
Route::get('emext-authorize', 'MainController@getHardAuthorize');
Route::get('cobra', 'MainController@getHardLogin');
