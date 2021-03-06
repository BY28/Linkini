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

Route::get('/', 'HomeController@index')->name('home');

Route::get('contact', function () {
    return view('contact');
})->name('contact');

Route::get('services', function () {
    return view('services');
})->name('services');

/* NEWSLETTER */

Route::get('newsletter', 'EmailController@getForm');
Route::post('newsletter', [
		'uses' => 'EmailController@postForm',
		'as' => 'storeEmail'
	]);

/*CONTACT*/

Route::post('contact', ['uses' => 'EmailController@sendContactMail', 'as' => 'sendContactEmail']);

Route::get('notifications/update', 'LinkController@updateNotifications')->name('notifications.update');
Route::get('messages/update', 'MessageController@unreadMessages')->name('messages.update');
/* PROFILE */

Route::group(['prefix' => 'profile'], function(){

Route::get('/', ['uses' => 'ProfileController@index', 'as' => 'profile.index']);
Route::get('projects', ['uses' => 'ProfileController@getProject', 'as' => 'profile.projects']);
Route::get('entreprise', ['uses' => 'ProfileController@getEntreprise', 'as' => 'profile.entreprise']);
Route::get('messages', ['uses' => 'ProfileController@getMessages', 'as' => 'profile.messages']);
Route::get('notifications', ['uses' => 'LinkController@getNotifications', 'as' => 'profile.notifications']);
Route::get('statistics', ['uses' => 'ProfileController@getStatistics', 'as' => 'profile.statistics']);


	Route::group(['prefix' => 'projects'], function(){
		Route::get('/', ['uses' => 'ProjectController@getUserProjects', 'as' => 'projects.all']);
		Route::get('/attributions', ['uses' => 'LinkController@getUserAttributionProjects', 'as' => 'projects.attributions']);
		Route::get('launched', ['uses' => 'LinkController@getUserLaunchedProjects', 'as' => 'projects.launched']);
		Route::get('create', ['uses' => 'ProjectController@create', 'as' => 'projects.create']);
		Route::post('update/{id}', ['uses' => 'ProjectController@update', 'as' => 'projects.update']);

		Route::post('launch', ['uses' => 'ProjectController@launch', 'as' => 'projects.launch']);

		Route::post('image/store/{id}', ['uses' => 'ProjectController@storeImage', 'as' => 'projects.storeImage']);
		Route::delete('image/delete/{id}', ['uses' => 'ProjectController@deleteImage', 'as' => 'projects.deleteImage']);

	});

	Route::group(['prefix' => 'entreprise'], function(){
		Route::get('/page', ['uses' => 'LinkiniPageController@getEntrepriseInfo', 'as' => 'entreprises.info']);
		Route::get('/waiting', ['uses' => 'EntrepriseController@getEntrepriseWaiting', 'as' => 'entreprises.waiting']);
		Route::get('/projects', ['uses' => 'LinkController@getPendingProjects', 'as' => 'entreprises.pendingProjects']);
		Route::get('/projects/attributions', ['uses' => 'LinkController@getAttributionProjects', 'as' => 'entreprises.attributionProjects']);
		Route::get('/projects/launched', ['uses' => 'LinkController@getLaunchedProjects', 'as' => 'entreprises.launchedProjects']);
		Route::get('/projects/canceled', ['uses' => 'LinkController@getCanceledProjects', 'as' => 'entreprises.canceledProjects']);
		
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
		Route::get('/', ['uses' => 'ProfileController@getSettingsAccount', 'as' => 'settings.account']);
		Route::post('/image/{id}', ['uses' => 'UserController@updateImage', 'as' => 'user.updateImage']);
		Route::get('entreprise', ['uses' => 'ProfileController@getSettingsEntreprise', 'as' => 'settings.entreprise']);
		//Route::get('notifications', ['uses' => 'ProfileController@getSettingsNotifications', 'as' => 'settings.notifications']);
	});
	
});

/* ENTREPRISES */

Route::group(['prefix' => 'entreprises'], function(){

	Route::get('/', ['uses' => 'EntrepriseController@index', 'as' => 'entreprises.index']);
	Route::get('order', ['uses' => 'EntrepriseController@getEntrepriseOrder', 'as' => 'entreprises.getorder']);
	Route::post('order', ['uses' => 'EntrepriseController@postEntrepriseOrder', 'as' => 'entreprises.postorder']);
	Route::post('links', ['uses' => 'LinkController@entrepriseLink', 'as' => 'links.entrepriselink']);
	Route::post('links/order', ['uses' => 'LinkController@linkOrder', 'as' => 'links.linkorder']);
	Route::post('links/unlink', ['uses' => 'LinkController@unlinkOrder', 'as' => 'links.unlinkorder']);
	Route::post('links/confirm', ['uses' => 'LinkController@attributionConfirm', 'as' => 'links.attributionConfirm']);


	Route::get('create', ['uses' => 'EntrepriseController@create', 'as' => 'entreprises.create']);
	Route::get('edit', ['uses' => 'EntrepriseController@edit', 'as' => 'entreprises.edit']);
	Route::post('destroy', ['uses' => 'EntrepriseController@edit', 'as' => 'entreprises.destroy']);

	Route::get('activity/{activity}', 'EntrepriseController@indexActivity')->name('entreprises.activityResults');
	Route::get('category/{category}', 'EntrepriseController@indexCategory')->name('entreprises.categoryResults');
	Route::get('search/{query}', 'EntrepriseController@indexName')->name('entreprises.nameResults');

		
});

/* PROJECT */
Route::group(['prefix' => 'projects'], function(){

	Route::post('links', ['uses' => 'LinkController@projectLink', 'as' => 'links.projectlink']);
	Route::post('links/accept', ['uses' => 'LinkController@attributionAccept', 'as' => 'links.attributionAccept']);
	Route::post('links/cancel', ['uses' => 'LinkController@attributionCancel', 'as' => 'links.attributionCancel']);
	Route::post('unlik', ['uses' => 'LinkController@projectUnLink', 'as' => 'links.projectunlink']);
	Route::get('canceled', ['uses' => 'LinkController@getProjectsCanceled', 'as' => 'projects.canceled']);
	Route::get('tag/{tag}', 'ProjectController@indexTag')->name('projects.tagResults');
	Route::get('category/{category}', 'ProjectController@indexCategory')->name('projects.categoryResults');
	Route::get('search/{query}', 'ProjectController@indexTitle')->name('projects.titleResults');

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
			Route::get('home', ['uses' => 'LinkiniPageController@getCarousel', 'as' => 'homepage.index']);
			Route::post('home', ['uses' => 'LinkiniPageController@storeCarousel', 'as' => 'homepage.storeCarousel']);
			Route::delete('destroy/{id}', ['uses' => 'LinkiniPageController@deleteCarouselImage', 'as' => 'homepage.deleteCarousel']);
		});

});

Route::group(['prefix' => 'page'], function(){
	Route::get('/{entreprise_url}', ['uses' => 'LinkiniPageController@show', 'as' => 'page.entreprise']);
	Route::put('/update/{id}', ['uses' => 'LinkiniPageController@updateContent', 'as' => 'page.update']);
	Route::post('/store/{category_name}', ['uses' => 'LinkiniPageController@createContent', 'as' =>'page.store']);
	Route::delete('/delete/{id}', ['uses' => 'LinkiniPageController@deleteContent', 'as' => 'page.delete']);
	Route::post('contact', ['uses' => 'EmailController@sendPageContactMail', 'as' => 'sendPageContactEmail']);
});


Route::get('search', 'SearchController@search')->name('search');
Route::post('search', 'SearchController@postSearch')->name('postSearch');

Route::resource('user', 'UserController');

Route::resource('entreprises', 'EntrepriseController');

Route::resource('projects', 'ProjectController', ['except' => ['create', 'update']]);

Route::resource('tags', 'TagController', ['only' => ['create', 'store']]);

Auth::routes();

Route::get('/home', 'HomeController@index');