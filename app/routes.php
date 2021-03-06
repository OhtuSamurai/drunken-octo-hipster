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

Route::put('updateSopivuus', 'AnswerController@updateSopivuus');//eikö tämän pitäisi olla post tai put

Route::post('committee/{id}/toggleopen', 'CommitteeController@toggleOpen');

Route::post('poll/{id}/toggleopen', 'PollController@toggleOpen');

Route::post('poll/{id}/makeacommittee', 'PollController@makeACommittee');

Route::post('poll/{id}/makeacopy', 'PollController@makeACopy');

Route::get('pooli', 'UserController@active');

Route::get('committee/{committee_id}/attachment/{id}','AttachmentController@download');

Route::get('poistetut', 'UserController@inactive');

Route::put('removeFromPool', 'UserController@removeFromPool');

Route::put('addToPool', 'UserController@addToPool');

Route::put('delete', 'UserController@delete');

Route::get('stats', 'StatsController@index');

Route::delete('commmittee/{committee_id}/attachment/{id}','AttachmentController@destroy');

Route::delete('poll/{poll_id}/edit/remove/{id}','LurkerController@destroy');

Route::resource('user', 'UserController',
                array('except' => array('index', 'destroy')));

Route::resource('poll', 'PollController',
                array('except' => array('destroy')));

Route::resource('timeidea', 'TimeideaController',
                array('only' => array('store', 'destroy')));

Route::resource('comment', 'CommentController');

Route::resource('answer', 'AnswerController');

Route::resource('committee', 'CommitteeController',
                array('except' => array('destroy')));

Route::resource('lurker', 'LurkerController',
				array('only' => array('store')));

Route::resource('/committee/{id}/attachment','AttachmentController');

Route::get('add', 'CommitteeController@store');
