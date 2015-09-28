<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'all', 'uses' => 'Visit@all']);
Route::get('/sharpen', ['as' => 'sharpen', 'uses' => 'Visit@sharpen']);
Route::get('/creation', ['as' => 'creation', 'uses' => 'Visit@creation']);
Route::get('/anecdote', ['as' => 'anecdote', 'uses' => 'Visit@anecdote']);
Route::get('/mind', ['as' => 'mind', 'uses' => 'Visit@mind']);
Route::get('/search', ['as' => 'search', 'uses' => 'Visit@search']);

Route::get('/archive/{id}', ['as' => 'archive', 'uses' => 'Visit@archive']);
Route::post('/try-mind', ['as' => 'try-mind', 'uses' => 'Visit@tryMind']);

Route::get('/error', ['as' => 'error', 'uses' => 'Visit@error']);

Route::post('/try-login', ['as' => 'try-login', 'uses' => 'Admin@tryLogin']);
Route::get('/try-logout', ['as' => 'try-logout', 'uses' => 'Admin@tryLogout']);
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function(){
	Route::get('archive', ['as' => 'archive-manage', 'uses' => 'Admin@archive']);
	Route::get('archive/edit/{id}', ['as' => 'archive-edit', 'uses' => 'Admin@archiveEdit']);
	Route::get('archive/new', ['as' => 'archive-new', 'uses' => 'Admin@archiveNew']);
	Route::post('archive-save', ['as' => 'archive-save', 'uses' => 'Admin@archiveSave']);
	Route::get('archive-delete', ['as' => 'archive-delete', 'uses' => 'Admin@archiveDelete']);
	Route::get('comment', ['as' => 'comment-manage', 'uses' => 'Admin@comment']);
	Route::get('comment-delete', ['as' => 'comment-delete', 'uses' => 'Admin@commentDelete']);
	Route::get('view', ['as' => 'view-manage', 'uses' => 'Admin@view']);
	Route::get('view-delete', ['as' => 'view-delete', 'uses' => 'Admin@viewDelete']);
});
