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

/* NEWSLETTER */

Route::get('newsletter', 'EmailController@getForm');
Route::post('newsletter', [
		'uses' => 'EmailController@postForm',
		'as' => 'storeEmail'
	]);

/* PROFILE */

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
		
		Route::get('notifications', [ 'uses' => 'MessageController@getNotifications', 'as' => 'messages.notifications']);

		Route::get('/', ['uses' => 'MessageController@getMessages', 'as' => 'messages.inbox']);
		Route::get('message/{id}', ['uses' => 'MessageController@getMessage', 'as' => 'messages.message']);
		Route::get('sent', ['uses' => 'MessageController@getMessageSent', 'as' => 'messages.sent']);
		Route::get('send', ['uses' => 'MessageController@getSendMessage', 'as' => 'messages.create']);
		Route::post('send', ['uses' => 'MessageController@sendMessage', 'as' => 'messages.send']);
		Route::post('send/{message}', ['uses' => 'MessageController@replyMessage', 'as' => 'messages.reply']);

	});

	Route::group(['prefix' => 'statistics'], function(){
		
	});

	Route::group(['prefix' => 'settings'], function(){
		Route::get('account', ['uses' => 'ProfileController@getSettingsAccount', 'as' => 'settings.account']);
		Route::get('entreprise', ['uses' => 'ProfileController@getSettingsEntreprise', 'as' => 'settings.entreprise']);
		Route::get('notifications', ['uses' => 'ProfileController@getSettingsNotifications', 'as' => 'settings.notifications']);
	});
	
});

/* ENTREPRISES */

Route::group(['prefix' => 'entreprises'], function(){

	Route::get('/', ['uses' => 'EntrepriseController@index', 'as' => 'entreprise.index']);
	Route::get('order', ['uses' => 'EntrepriseController@getEntrepriseOrder', 'as' => 'entreprise.getorder']);
	Route::post('order', ['uses' => 'EntrepriseController@postEntrepriseOrder', 'as' => 'entreprise.postorder']);

	Route::get('create', ['uses' => 'EntrepriseController@create', 'as' => 'entreprise.create']);
	Route::get('edit', ['uses' => 'EntrepriseController@edit', 'as' => 'entreprise.edit']);
	Route::post('destroy', ['uses' => 'EntrepriseController@edit', 'as' => 'entreprise.destroy']);
		
});


/* ADMIN */

Route::group(['prefix' => 'admin'], function(){

	Route::group(['prefix' => 'entreprises'], function(){
	
	Route::get('/', ['uses' => 'EntrepriseController@getPendingEntreprises', 'as' => 'entreprise.getpending']);
	Route::get('accepted', ['uses' => 'EntrepriseController@getAcceptedEntreprises', 'as' => 'entreprise.getaccepted']);
	Route::get('checked', ['uses' => 'EntrepriseController@getCheckedEntreprises', 'as' => 'entreprise.getchecked']);

	Route::post('accept', ['uses' => 'EntrepriseController@accept', 'as' => 'entreprise.accept']);
	});
	Route::post('check', ['uses' => 'EntrepriseController@check', 'as' => 'entreprise.check']);		
});


Route::resource('user', 'UserController');

Route::resource('entreprises', 'EntrepriseController');

Route::resource('projects', 'ProjectController');

Route::resource('tags', 'TagController', ['only' => ['create', 'store']]);

Route::get('project/tag/{tag}', 'ProjectController@indexTag');

Auth::routes();

Route::get('/home', 'HomeController@index');