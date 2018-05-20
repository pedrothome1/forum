<?php

Auth::routes();

Route::get('/', 'ThreadsController@index')->name('home');
