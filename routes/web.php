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
})->name('home');

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
Route::get('notifications', ['uses' => 'LinkController@getNotifications', 'as' => 'profile.notifications']);
Route::get('statistics', ['uses' => 'ProfileController@getStatistics', 'as' => 'profile.statistics']);
Route::get('settings', ['uses' => 'ProfileController@getSettings', 'as' => 'profile.settings']);


	Route::group(['prefix' => 'projects'], function(){
		Route::get('/', ['uses' => 'ProjectController@getPending', 'as' => 'projects.pending']);
		Route::get('launched', ['uses' => 'ProjectController@getLaunched', 'as' => 'projects.launched']);
		Route::get('create', ['uses' => 'ProjectController@create', 'as' => 'projects.create']);

		Route::post('launch', ['uses' => 'ProjectController@launch', 'as' => 'projects.launch']);
	});

	Route::group(['prefix' => 'entreprise'], function(){
		Route::get('/', ['uses' => 'EntrepriseController@getEntrepriseInfo', 'as' => 'entreprises.info']);
		Route::get('/waiting', ['uses' => 'EntrepriseController@getEntrepriseWaiting', 'as' => 'entreprises.waiting']);
		
	});

	Route::group(['prefix' => 'messages'], function(){
		
		Route::get('notifications', [ 'uses' => 'MessageController@getNotifications', 'as' => 'messages.notifications']);

		Route::get('/', ['uses' => 'MessageController@getMessages', 'as' => 'messages.inbox']);
		Route::get('message/{id}', ['uses' => 'MessageController@getMessage', 'as' => 'messages.message']);
		Route::get('receiver/{id}', ['uses' => 'MessageController@getSendMessageWithReceiver', 'as' => 'messages.sendwithreceiver']);
		Route::get('sent', ['uses' => 'MessageController@getMessageSent', 'as' => 'messages.sent']);
		Route::get('send', ['uses' => 'MessageController@getSendMessage', 'as' => 'messages.create']);
		Route::post('send', ['uses' => 'MessageController@sendMessage', 'as' => 'messages.send']);
		Route::post('send/{message}', ['uses' => 'MessageController@replyMessage', 'as' => 'messages.reply']);

	});

	Route::group(['prefix' => 'favorites'], function(){

		Route::get('/', ['uses' => 'FavoriteController@getFavorites', 'as' => 'profile.favorites']);
		Route::post('entreprise', ['uses' => 'FavoriteController@addFav', 'as' => 'favorites.add']);

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

	Route::get('/', ['uses' => 'EntrepriseController@index', 'as' => 'entreprises.index']);
	Route::get('order', ['uses' => 'EntrepriseController@getEntrepriseOrder', 'as' => 'entreprises.getorder']);
	Route::post('order', ['uses' => 'EntrepriseController@postEntrepriseOrder', 'as' => 'entreprises.postorder']);
	Route::post('links', ['uses' => 'LinkController@entrepriseLink', 'as' => 'links.entrepriselink']);

	Route::get('create', ['uses' => 'EntrepriseController@create', 'as' => 'entreprises.create']);
	Route::get('edit', ['uses' => 'EntrepriseController@edit', 'as' => 'entreprises.edit']);
	Route::post('destroy', ['uses' => 'EntrepriseController@edit', 'as' => 'entreprises.destroy']);

	Route::get('activity/{activity}', 'EntrepriseController@indexActivity')->name('entreprises.activityResults');
	Route::get('category/{category}', 'EntrepriseController@indexCategory')->name('entreprises.categoryResults');

		
});

/* PROJECT */
Route::group(['prefix' => 'projects'], function(){

	Route::post('links', ['uses' => 'LinkController@projectLink', 'as' => 'links.projectlink']);
	Route::get('tag/{tag}', 'ProjectController@indexTag')->name('projects.tagResults');
	Route::get('category/{category}', 'ProjectController@indexCategory')->name('projects.categoryResults');

});

/* ADMIN */

Route::group(['prefix' => 'admin'], function(){

	Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admins.index']);

	Route::group(['prefix' => 'categories'], function(){
		Route::get('/', ['uses' => 'CategoryController@index', 'as' => 'categories.index']);
		Route::post('/', ['uses' => 'CategoryController@store', 'as' => 'categories.store']);
		Route::post('update', ['uses' => 'CategoryController@update', 'as' => 'categories.update']);
		Route::delete('delete', ['uses' => 'CategoryController@destroy', 'as' => 'categories.delete']);
		
		Route::group(['prefix' => 'activities'], function(){
			Route::get('/{id}', ['uses' => 'CategoryController@show', 'as' => 'activities.index']);
			Route::post('/', ['uses' => 'ActivityController@store', 'as' => 'activities.store']);
			Route::post('update', ['uses' => 'ActivityController@update', 'as' => 'activities.update']);
			Route::delete('delete', ['uses' => 'ActivityController@destroy', 'as' => 'activities.delete']);
		});

		Route::post('activity', ['uses' => 'ActivityController@store', 'as' => 'activity.store']);
	});

	Route::group(['prefix' => 'entreprises'], function(){
	
	Route::get('/', ['uses' => 'EntrepriseController@getPendingEntreprises', 'as' => 'entreprises.getpending']);
	Route::get('accepted', ['uses' => 'EntrepriseController@getAcceptedEntreprises', 'as' => 'entreprises.getaccepted']);
	Route::get('checked', ['uses' => 'EntrepriseController@getCheckedEntreprises', 'as' => 'entreprises.getchecked']);

	Route::post('accept', ['uses' => 'EntrepriseController@accept', 'as' => 'entreprises.accept']);
	Route::post('check', ['uses' => 'EntrepriseController@check', 'as' => 'entreprises.check']);	
	});
	
	Route::group(['prefix' => 'pages'], function(){
			Route::get('home', ['uses' => 'LinkiniPageController@index', 'as' => 'homepage.index']);
			Route::post('home', ['uses' => 'LinkiniPageController@storeCarousel', 'as' => 'homepage.storeCarousel']);
			//Route::delete('delete', ['uses' => 'LinkiniPageController@destroy', 'as' => 'homepage.deleteCarousel']);
			Route::delete('destroy/{id}', ['uses' => 'LinkiniPageController@destroy', 'as' => 'homepage.deleteCarousel']);
		});

});
Route::get('search', 'ActivityController@search');

Route::resource('user', 'UserController');

Route::resource('entreprises', 'EntrepriseController');

Route::resource('projects', 'ProjectController', ['except' => ['create']]);

Route::resource('tags', 'TagController', ['only' => ['create', 'store']]);

Auth::routes();

Route::get('/home', 'HomeController@index');