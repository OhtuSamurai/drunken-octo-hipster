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

Route::get('pooli', 'UserController@active');

Route::get('committee/{committee_id}/attachment/{id}','AttachmentController@download');

Route::get('poistetut', 'UserController@inactive');

Route::put('removeFromPool', 'UserController@removeFromPool');

Route::put('addToPool', 'UserController@addToPool');

Route::put('delete', 'UserController@delete');

Route::delete('commmittee/{committee_id}/attachment/{id}','AttachmentController@destroy');

Route::resource('user', 'UserController',
                array('except' => array('index', 'destroy')));



Route::resource('poll', 'PollController',
                array('except' => array('destroy')));

Route::resource('timeidea', 'TimeideaController',
                array('only' => array('store')));

Route::resource('comment', 'CommentController');

Route::resource('answer', 'AnswerController',
                array('only' => array('store')));

Route::resource('committee', 'CommitteeController',
                array('except' => array('destroy', 'edit')));

Route::resource('lurker', 'LurkerController',
				array('only' => array('store')));

Route::resource('/committee/{id}/attachment','AttachmentController');

Route::get('add', 'CommitteeController@store');
