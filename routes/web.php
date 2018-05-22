<?php

Auth::routes();

Route::get('/{category?}', 'ThreadsController@index')->name('home');
Route::get('/threads/create', 'ThreadsController@create');
Route::get('/threads/{thread}', 'ThreadsController@show');
Route::post('/threads', 'ThreadsController@store');
