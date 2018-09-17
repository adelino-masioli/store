<?php

Route::get('/', 'HomeController@index');
Route::get('/sobre', 'HomeController@about');
Route::get('/contato', 'HomeController@contact');
Route::get('/produtos/{category}', 'ProductController@index');
Route::get('/produto/{product}', 'ProductController@show');

Route::post('/enviar-newsletter', 'HomeController@postNewsletter')->name('post-newsletter');
Route::post('/enviar-orcamento', 'HomeController@postQuote')->name('post-quote');
Route::post('/enviar-contato', 'HomeController@postContact')->name('post-contact');
Route::post('/busca', 'HomeController@result');
