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

Route::get('user/create', function() {
    App::abort(404);
});
Route::get('user', function() {
    App::abort(404);
});

//Route::post('activity/{id}/participate', 'ActivityController@participate');
//Route::post('activity/{id}/leave', 'ActivityController@leave');
Route::post('bbs/{id}/reply', 'ReplyController@store');
Route::post('bug/{id}/comment', 'CommentController@store');
Route::get('/', array('uses' => 'HomeController@getIndex'));
Route::get('/search', array('uses' => 'HomeController@getSearch'));
Route::get('/ranks', array('uses' => 'HomeController@getRanks'));
Route::get('/signup', array('uses' => 'UserController@create'));
Route::get('/signin', array('uses' => 'SessionController@create'));
Route::get('/logout', array('uses' => 'SessionController@destroy'));

Route::resource('user', 'UserController', array(
    'except' => array('index', 'create')
));
Route::resource('session', 'SessionController');
Route::resource('bug', 'BugController');
Route::resource('bbs', 'BbsController');
Route::resource('comment', 'CommentController');
Route::resource('reply', 'ReplyController');
Route::resource('topic', 'TopicController');
Route::resource('activity', 'ActivityController');

Route::controller('admin', 'AdminController');
Route::controller('/', 'DashboardController');

