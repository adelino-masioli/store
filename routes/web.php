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
});
