<?php
Route::get('/', 'SiteController@index')->name('frontend-home');
Route::get('/sobre', 'SiteController@about')->name('frontend-about');
Route::get('/produtos', 'SiteController@product')->name('frontend-products');
Route::get('/produtos/{category}', 'SiteController@category')->name('frontend-product-categories');
Route::get('/produto/{product}', 'SiteController@show')->name('frontend-product-detail');
Route::get('/servicos', 'SiteController@service')->name('frontend-service');
Route::get('/contato', 'SiteController@contact')->name('frontend-contact');

Route::post('/busca', 'SiteController@result')->name('frontend-product-result');
Route::post('/enviar-newsletter', 'SiteController@postNewsletter')->name('post-newsletter');
Route::post('/enviar-orcamento', 'SiteController@postQuote')->name('post-quote');
Route::post('/enviar-contato', 'SiteController@postContact')->name('post-contact');