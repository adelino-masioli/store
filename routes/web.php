<?php

Route::get('/', 'HomeController@index');
Route::get('/sobre', 'HomeController@about');
Route::get('/contato', 'HomeController@contact');
Route::get('/produtos/{category}', 'ProductController@index');
Route::get('/produto/{product}', 'ProductController@show');