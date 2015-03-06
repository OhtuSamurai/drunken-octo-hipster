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

Route::get('login', 'LoginController@showLoginPage');

Route::post('login', 'LoginController@doLogin');

Route::get('logout', 'LoginController@logout');

Route::get('pooli', 'UserController@index');

Route::get('updateSopivuus', 'AnswerController@updateSopivuus');

Route::get('admin', 'AdminController@showAdminPage');

Route::resource('user', 'UserController',
                array('except' => array('create', 'store', 'destroy', 'update', 'edit', 'index')));

Route::resource('poll', 'PollController',
                array('except' => array('destroy', 'edit', 'create')));

Route::resource('timeidea', 'TimeideaController',
                array('only' => array('store')));

Route::resource('answer', 'AnswerController',
                array('only' => array('store')));

Route::resource('committee', 'CommitteeController',
                array('only' => array('index', 'show', 'store')));

Route::get('add', 'CommitteeController@store');

