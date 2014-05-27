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


Route::resource('user', 'UserController', array(
    'except' => array('create')
));

Route::resource('session', 'SessionController');

Route::resource('bug', 'BugController');

Route::get('/', array('uses' => 'HomeController@getIndex'));
Route::get('signup', array('uses' => 'UserController@create'));
Route::get('signin', array('uses' => 'SessionController@create'));
Route::get('logout', array('uses' => 'SessionController@destroy'));

