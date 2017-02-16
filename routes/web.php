<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('newsletter', 'EmailController@getForm');
Route::post('newsletter', [
		'uses' => 'EmailController@postForm',
		'as' => 'storeEmail'
	]);

Route::group(['prefix' => 'profile'], function(){

Route::get('/', ['uses' => 'ProfileController@index', 'as' => 'profile.index']);
Route::get('projects', ['uses' => 'ProfileController@getProject', 'as' => 'profile.projects']);
Route::get('entreprise', ['uses' => 'ProfileController@getEntreprise', 'as' => 'profile.entreprise']);
Route::get('messages', ['uses' => 'ProfileController@getMessages', 'as' => 'profile.messages']);
Route::get('notifications', ['uses' => 'ProfileController@getNotifications', 'as' => 'profile.notifications']);
Route::get('favorties', ['uses' => 'ProfileController@getFavorite', 'as' => 'profile.favorties']);
Route::get('statistics', ['uses' => 'ProfileController@getStatistics', 'as' => 'profile.statistics']);
Route::get('settings', ['uses' => 'ProfileController@getSettings', 'as' => 'profile.settings']);


	Route::group(['prefix' => 'projects'], function(){
		
	});

	Route::group(['prefix' => 'entreprise'], function(){
		
	});

	Route::group(['prefix' => 'messages'], function(){
		
	});

	Route::group(['prefix' => 'statistics'], function(){
		
	});

	Route::group(['prefix' => 'settings'], function(){
		Route::get('account', ['uses' => 'ProfileController@getAccount', 'as' => 'settings.account']);
	});
	
});

Route::resource('user', 'UserController');

Route::resource('entreprise', 'EntrepriseController');

Route::resource('project', 'ProjectController');

Route::resource('tag', 'TagController', ['only' => ['create', 'store']]);

Route::get('project/tag/{tag}', 'ProjectController@indexTag');

Auth::routes();

Route::get('/home', 'HomeController@index');
