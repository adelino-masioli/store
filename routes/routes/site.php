<?php
Route::get('/', 'SiteController@index')->name('frontend-home');
Route::get('/sobre', 'SiteController@about')->name('frontend-about');
Route::get('/produtos', 'SiteController@product')->name('frontend-products');
Route::get('/produtos/{category}', 'SiteController@category')->name('frontend-product-categories');
Route::get('/produto/{product}', 'SiteController@show')->name('frontend-product-detail');
Route::get('/produto-avaliacao/{product}/{rate}', 'SiteController@rate')->name('frontend-product-rate');
Route::get('/servicos', 'SiteController@service')->name('frontend-service');
Route::get('/contato', 'SiteController@contact')->name('frontend-contact');
Route::get('/termos', 'SiteController@terms')->name('frontend-terms');
Route::get('/privacidade', 'SiteController@privacy')->name('frontend-privacy');

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
Route::get('/recuperar-senha', 'UserController@email')->name('frontend-email-password');
Route::get('/link-para-recuperar-senha-enviado-com-sucesso', 'UserController@emailSuccess')->name('frontend-email-password-success');
Route::get('/alterar-senha/{token}', 'UserController@reset')->name('frontend-reset-password');
Route::get('/sair', 'UserController@logout')->name('frontend-logout');
Route::get('/esqueci-minha-senha', 'UserController@login')->name('frontend-login-forgot');
Route::get('/cadastre-se', 'UserController@register')->name('frontend-register');
Route::get('/cadastro-com-sucesso', 'UserController@registerSuccess')->name('frontend-register-success');
Route::get('/cadastro-ativado/{token}', 'UserController@activate')->name('frontend-register-activate');
Route::get('/cadastro-ativado-com-sucesso', 'UserController@activatePage')->name('frontend-register-activate-success');
Route::post('/logar', 'UserController@postLogin')->name('frontend-login-post');
Route::post('/cadastrar', 'UserController@postRegister')->name('frontend-register-post');
Route::post('/atualizar', 'UserController@postUpdate')->name('frontend-register-update');
Route::post('/recuperar-senha-link', 'UserController@postEmail')->name('frontend-email-post');
Route::post('/alterar-minha-senha', 'UserController@postReset')->name('frontend-reset-my-password');

//dashboard
Route::get('/minha-conta', 'DashboardController@index')->name('frontend-my-account')->middleware('checkauth');
Route::get('/meus-pedidos', 'DashboardController@order')->name('frontend-my-account-order')->middleware('checkauth');
Route::get('/meu-pedido/{order}', 'DashboardController@orderDetail')->name('frontend-my-account-order-detail')->middleware('checkauth');
Route::get('/suporte-ao-cliente', 'DashboardController@support')->name('frontend-my-account-support')->middleware('checkauth');

//correio
Route::post('/calcular-envio-correios', 'CorreioController@calculate')->name('frontend-calculate-dispatch');
