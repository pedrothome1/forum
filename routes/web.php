<?php

Auth::routes();

Route::get('/{category?}', 'ThreadsController@index')->name('home');
Route::get('/threads/create', 'ThreadsController@create')->middleware('auth');
Route::get('/threads/{thread}', 'ThreadsController@show');
Route::post('/threads', 'ThreadsController@store')->middleware('auth');

Route::post('/threads/{thread}/replies', 'RepliesController@store')->middleware('auth');

Route::post('/favorites/{reply}', 'FavoritesController@toggleReply')->where('reply', '[0-9]+')->middleware('auth');
Route::post('/favorites/{thread}', 'FavoritesController@toggleThread')->middleware('auth');
