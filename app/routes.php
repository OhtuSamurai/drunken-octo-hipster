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

Route::get('testi', function()
{
	return View::make('testi');
});

Route::get('/', 'UserController@pooli');

Route::get('pooli', 'UserController@pooli');

Route::get('polls', 'PollController@list_polls');

Route::get('template','PollController@template');

Route::get('poll/{id}', 'PollController@show_poll');

Route::post('#', 'PollController@create');
