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
Route::get('/', 'UserController@index');

Route::get('pooli', 'UserController@index');

Route::get('polls', 'PollController@list_polls');

Route::get('template','PollController@template');

Route::get('poll/{id}', 'PollController@show_poll');

Route::post('#', 'PollController@create');

Route::resource('user', 'UserController',
                array('except' => array('create', 'store', 'destroy', 'update', 'edit', 'show')));
