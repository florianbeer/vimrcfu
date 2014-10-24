<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);
Route::get('login', ['as' => 'login', 'uses' => 'AuthorizationController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthorizationController@destroy']);
Route::model('snippet', 'Snippet');
Route::resource('snippet', 'SnippetsController');
