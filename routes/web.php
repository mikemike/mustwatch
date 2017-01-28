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

Route::get('/', 'HomeController@index');

// Account and auth
Auth::routes();
Route::get('account', ['uses' => 'AccountController@index', 'as' => 'account']);
Route::post('account', ['uses' => 'AccountController@account_submit', 'as' => 'account.submit']);

// Movie search
Route::get('/search', ['uses' => 'SearchController@index', 'as' => 'search']);
Route::get('/search/ajax', ['uses' => 'SearchController@ajax_search', 'as' => 'search.ajax']);

// AJAX
Route::get('/ajax/add_movie_to_watch', ['uses' => 'MovieController@ajax_add_movie', 'as' => 'add.ajax']);
Route::get('/ajax/remove_movie_from_watch', ['uses' => 'MovieController@ajax_remove_movie', 'as' => 'remove.ajax']);
Route::get('/ajax/mark_watched', ['uses' => 'MovieController@ajax_mark_watched', 'as' => 'watch.ajax']);
Route::get('/ajax/mark_unwatched', ['uses' => 'MovieController@ajax_mark_unwatched', 'as' => 'unwatch.ajax']);

// Movie view
Route::get('/title/{slug}/{id}', ['uses' => 'MovieController@view', 'as' => 'movie.view']);