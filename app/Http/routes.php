<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('oauth/callback', 'icebreakerController@oauthCallback');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
   	
   	Route::get('demo', 'PagesController@demo');

   	Route::post('fullcontact', 'icebreakerController@fullcontact');

   	Route::get('oauth/twitter', 'icebreakerController@testTwitterAuth');

	Route::get('authenticate', 'PagesController@authenticate');

	Route::get('connect', 'PagesController@connect');

	/**
	 * oAuth
	 */
	
	Route::get('auth/linkedin', 'Auth\AuthController@redirectToLinkedin');

	Route::get('auth/linkedin/callback', 'Auth\AuthController@handleLinkedinCallback');

	Route::get('auth/twitter', 'Auth\AuthController@redirectToTwitter');

	Route::get('auth/twitter/callback', 'Auth\AuthController@handleTwitterCallback');
   	
});
