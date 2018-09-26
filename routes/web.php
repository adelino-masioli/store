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
//Route::get('/register', 'HomeController@index')->name('home');
//Route::get('/register', function (){
//   return bcrypt("123456");
//});

//admin products
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/register', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    //configuration
    Route::get('/configuration', 'ConfigurationController@myConfig')->name('configuration');
    Route::get('/configurations', 'ConfigurationController@index')->name('configurations');
    Route::get('/datatable-configurations', 'ConfigurationController@getDatatable')->name('datatable-configurations');
    Route::get('/configuration/create', 'ConfigurationController@create')->name('configuration-create');
    Route::post('/configuration/store', 'ConfigurationController@store')->name('configuration-store');
    Route::get('/configuration/edit/{id}', 'ConfigurationController@edit')->name('configuration-edit');
    Route::get('/configuration/destroy/{id}', 'ConfigurationController@destroy')->name('configuration-destroy');
    Route::post('/configuration/update', 'ConfigurationController@update')->name('configuration-update');

    //user
    Route::get('/user/me', 'UserController@me')->name('me');
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/datatable-users', 'UserController@getDatatable')->name('datatable-users');
    Route::get('/user/create', 'UserController@create')->name('user-create');
    Route::post('/user/store', 'UserController@store')->name('user-store');
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user-edit');
    Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user-destroy');
    Route::post('/user/update', 'UserController@update')->name('user-update');

    //product
    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/datatable-products', 'ProductController@getDatatable')->name('datatable-products');
    Route::get('/product/create', 'ProductController@create')->name('product-create');
    Route::post('/product/store', 'ProductController@store')->name('product-store');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product-edit');
    Route::get('/product/destroy/{id}', 'ProductController@destroy')->name('product-destroy');
    Route::post('/product/update', 'ProductController@update')->name('product-update');
    Route::post('/product/category', 'ProductController@productCategory')->name('product-category');
    Route::post('/product/image/store', 'ProductImageController@store')->name('product-image-store');
    Route::get('/product/image/destroy/{id}', 'ProductImageController@destroy')->name('product-image-destroy');

    //category
    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::get('/datatable-categories', 'CategoryController@getDatatable')->name('datatable-categories');
    Route::get('/category/create', 'CategoryController@create')->name('category-create');
    Route::post('/category/store', 'CategoryController@store')->name('category-store');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category-edit');
    Route::get('/category/destroy/{id}', 'CategoryController@destroy')->name('category-destroy');
    Route::post('/category/update', 'CategoryController@update')->name('category-update');

    //contact
    Route::get('/contacts', 'ContactController@index')->name('contacts');
    Route::get('/datatable-contacts', 'ContactController@getDatatable')->name('datatable-contacts');
    Route::get('/contact/edit/{id}', 'ContactController@edit')->name('contact-edit');
    Route::get('/contact/destroy/{id}', 'ContactController@destroy')->name('contact-destroy');
    Route::post('/contact/update', 'ContactController@update')->name('contact-update');

    //quote
    Route::get('/quotes', 'QuoteController@index')->name('quotes');
    Route::get('/datatable-quotes', 'QuoteController@getDatatable')->name('datatable-quotes');
    Route::get('/quote/edit/{id}', 'QuoteController@edit')->name('quote-edit');
    Route::get('/quote/destroy/{id}', 'QuoteController@destroy')->name('quote-destroy');
    Route::post('/quote/update', 'QuoteController@update')->name('quote-update');

    //newsletter
    Route::get('/newsletters', 'NewsletterController@index')->name('newsletters');
    Route::get('/datatable-newsletters', 'NewsletterController@getDatatable')->name('datatable-newsletters');
});
