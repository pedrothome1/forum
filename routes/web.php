<?php

Auth::routes();

Route::get('/{category?}', 'ThreadsController@index')->name('home');
Route::get('/threads/create', 'ThreadsController@create')->middleware('auth');
Route::get('/threads/{thread}', 'ThreadsController@show');
Route::post('/threads', 'ThreadsController@store')->middleware('auth');
Route::get('/threads/{thread}/edit', 'ThreadsController@edit')->middleware('auth');
Route::patch('/threads/{thread}', 'ThreadsController@update')->middleware('auth');

Route::get('/threads/{thread}/replies', 'RepliesController@index');
Route::post('/threads/{thread}/replies', 'RepliesController@store')->middleware('auth');
Route::patch('/replies/{reply}', 'RepliesController@update')->middleware('auth');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->middleware('auth');

Route::post('/replies/{reply}/best', 'BestRepliesController@store')->middleware('auth');

Route::post('/favorites/{reply}', 'FavoritesController@toggleReply')->where('reply', '[0-9]+')->middleware('auth');
Route::post('/favorites/{thread}', 'FavoritesController@toggleThread')->middleware('auth');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles');