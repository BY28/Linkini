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
    return view('welcome');
});

Route::get('newsletter', 'EmailController@getForm');
Route::post('newsletter', [
		'uses' => 'EmailController@postForm',
		'as' => 'storeEmail'
	]);

Route::resource('user', 'UserController');

Route::resource('entreprise', 'EntrepriseController');

Route::resource('project', 'ProjectController');

Route::resource('tag', 'TagController', ['only' => ['create', 'store']]);

Route::get('project/tag/{tag}', 'ProjectController@indexTag');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/cheZoubir', 'HomeController@index');
