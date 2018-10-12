<?php
Route::get('/', 'SiteController@index')->name('frontend-home');
Route::get('/sobre', 'SiteController@about')->name('frontend-about');
Route::get('/produtos', 'SiteController@product')->name('frontend-products');
Route::get('/produtos/{category}', 'SiteController@category')->name('frontend-product-categories');
Route::get('/produto/{product}', 'SiteController@show')->name('frontend-product-detail');
Route::get('/servicos', 'SiteController@service')->name('frontend-service');
Route::get('/contato', 'SiteController@contact')->name('frontend-contact');

//filters
Route::get('/busca/', 'SiteController@result')->name('frontend-product-result');

Route::post('/enviar-newsletter', 'SiteController@postNewsletter')->name('post-newsletter');
Route::post('/enviar-orcamento', 'SiteController@postQuote')->name('post-quote');
Route::post('/enviar-contato', 'SiteController@postContact')->name('post-contact');

//shopping cart
Route::get('/carrinho', 'ShoppingcartController@index')->name('frontend-shoppingcart-home');
Route::get('/adicionar-ao-carrrinho/{product}/{id}', 'ShoppingcartController@store')->name('frontend-add-cart');
Route::post('/atulizat-carrrinho/{product}', 'ShoppingcartController@update')->name('frontend-update-cart');
Route::get('/remover-do-carrrinho/{product}/{id}', 'ShoppingcartController@remove')->name('frontend-remove-cart');
Route::get('/finalizar-carrrinho/{shopcart}', 'ShoppingcartController@finish')->name('frontend-finish-cart');


//user
Route::get('/entrar', 'UserController@login')->name('frontend-login');
Route::get('/termos', 'UserController@terms')->name('frontend-terms');
Route::get('/privacidade', 'UserController@privacy')->name('frontend-privacy');
Route::get('/cadastre-se', 'UserController@register')->name('frontend-register');
Route::get('/cadastro-com-sucesso', 'UserController@register')->name('frontend-register-success');
Route::get('/minha-conta', 'UserController@index')->name('frontend-my-account');
Route::post('/logar', 'UserController@postLogin')->name('frontend-login-post');
Route::post('/cadastrar', 'UserController@postRegister')->name('frontend-register-post');
