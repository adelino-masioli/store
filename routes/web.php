<?php

Route::get('/', 'SiteController@index');
Route::get('/sobre', 'SiteController@about');
Route::get('/contato', 'SiteController@contact');
Route::get('/produtos/{category}', 'ProductController@index');
Route::get('/produto/{product}', 'ProductController@show');

Route::post('/enviar-newsletter', 'SiteController@postNewsletter')->name('post-newsletter');
Route::post('/enviar-orcamento', 'SiteController@postQuote')->name('post-quote');
Route::post('/enviar-contato', 'SiteController@postContact')->name('post-contact');
Route::post('/busca', 'SiteController@result');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', 'HomeController@index')->name('home');

//admin products
Route::get('/datatable-products', 'Admin\ProductController@getDatatable');
Route::get('/product-edit/{id}', 'Admin\ProductController@edit')->name('product-edit');
Route::get('/product-destroy/{id}', 'Admin\ProductController@destroy')->name('product-destroy');
Route::post('/product-update', 'Admin\ProductController@update')->name('product-update');
Route::post('/product-category', 'Admin\ProductController@productCategory')->name('product-category');
