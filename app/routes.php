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
Route::get('/', 'CommitteeController@index');

Route::get('login', 'LoginController@showLoginPage');

Route::post('login', 'LoginController@login');

Route::get('logout', 'LoginController@logout');

Route::get('updateSopivuus', 'AnswerController@updateSopivuus');//eikö tämän pitäisi olla post tai put

Route::post('committee/{id}/toggleopen', 'CommitteeController@toggleOpen');

Route::get('pooli', 'UserController@active');

Route::get('poistetut', 'UserController@inactive');

Route::resource('user', 'UserController',
                array('except' => array('index', 'destroy')));

Route::resource('poll', 'PollController',
                array('except' => array('destroy', 'edit')));

Route::resource('timeidea', 'TimeideaController',
                array('only' => array('store')));

Route::resource('answer', 'AnswerController',
                array('only' => array('store')));

Route::resource('committee', 'CommitteeController',
                array('except' => array('destroy', 'edit')));

Route::get('add', 'CommitteeController@store');

