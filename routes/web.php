<?php

Route::get('/', 'SiteController@index');
Route::get('/sobre', 'SiteController@about');
Route::get('/contato', 'SiteController@contact');
Route::get('/produtos/{category}', 'ProductController@index');
Route::get('/produto/{product}', 'ProductController@show');

Route::post('/enviar-newsletter', 'SiteController@postNewsletter')->name('post-newsletter');
Route::post('/enviar-orcamento', 'SiteController@postQuote')->name('post-order');
Route::post('/enviar-contato', 'SiteController@postContact')->name('post-contact');
Route::post('/busca', 'SiteController@result');

Auth::routes();
//Route::get('/register', 'HomeController@index')->name('home');
//Route::get('/register', function (){
//   return bcrypt("123456");
//});

//admin products
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/register', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //configuration
    Route::get('/configuration', 'ConfigurationController@myConfig')->name('configuration');
    Route::get('/configurations', 'ConfigurationController@index')->name('configurations');
    Route::get('/datatable-configurations', 'ConfigurationController@getDatatable')->name('datatable-configurations');
    Route::get('/configuration/create', 'ConfigurationController@create')->name('configuration-create');
    Route::post('/configuration/store', 'ConfigurationController@store')->name('configuration-store');
    Route::get('/configuration/edit/{id}', 'ConfigurationController@edit')->name('configuration-edit');
    Route::get('/configuration/destroy/{id}', 'ConfigurationController@destroy')->name('configuration-destroy');
    Route::post('/configuration/update', 'ConfigurationController@update')->name('configuration-update');
    Route::post('/configuration/brand', 'ConfigurationController@updateBrand')->name('configuration-brand');
    Route::get('/configuration/brand-destroy/{id}', 'ConfigurationController@destroyBrand')->name('configuration-brand-destroy');


    //user
    Route::get('/user/me', 'UserController@me')->name('me');
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/datatable-users', 'UserController@getDatatable')->name('datatable-users');
    Route::get('/user/create', 'UserController@create')->name('user-create');
    Route::post('/user/store', 'UserController@store')->name('user-store');
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user-edit');
    Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user-destroy');
    Route::post('/user/update', 'UserController@update')->name('user-update');
    Route::post('/user/avatar', 'UserController@updateAvatar')->name('user-avatar');
    Route::get('/user/avatar-destroy/{id}', 'UserController@destroyAvatar')->name('user-avatar-destroy');
    Route::post('/user/search', 'UserController@search')->name('user-search');

    //product
    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/datatable-products', 'ProductController@getDatatable')->name('datatable-products');
    Route::get('/product/create', 'ProductController@create')->name('product-create');
    Route::post('/product/store', 'ProductController@store')->name('product-store');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product-edit');
    Route::get('/product/destroy/{id}', 'ProductController@destroy')->name('product-destroy');
    Route::post('/product/update', 'ProductController@update')->name('product-update');
    Route::post('/product/category', 'ProductController@productCategory')->name('product-category');
    Route::post('/product/subcategory', 'ProductController@producSubCategory')->name('product-subcategory');
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

    //subcategory
    Route::get('/subcategories', 'SubCategoryController@index')->name('subcategories');
    Route::get('/datatable-subcategories', 'SubCategoryController@getDatatable')->name('datatable-subcategories');
    Route::get('/subcategory/create', 'SubCategoryController@create')->name('subcategory-create');
    Route::post('/subcategory/store', 'SubCategoryController@store')->name('subcategory-store');
    Route::get('/subcategory/edit/{id}', 'SubCategoryController@edit')->name('subcategory-edit');
    Route::get('/subcategory/destroy/{id}', 'SubCategoryController@destroy')->name('subcategory-destroy');
    Route::post('/subcategory/update', 'SubCategoryController@update')->name('subcategory-update');

    //contact
    Route::get('/contacts', 'ContactController@index')->name('contacts');
    Route::get('/datatable-contacts', 'ContactController@getDatatable')->name('datatable-contacts');
    Route::get('/contact/edit/{id}', 'ContactController@edit')->name('contact-edit');
    Route::get('/contact/destroy/{id}', 'ContactController@destroy')->name('contact-destroy');
    Route::post('/contact/update', 'ContactController@update')->name('contact-update');

    //order
    Route::get('/orders', 'OrderController@index')->name('orders');
    Route::get('/datatable-orders', 'OrderController@getDatatable')->name('datatable-orders');
    Route::get('/order/create', 'OrderController@create')->name('order-create');
    Route::post('/order/store', 'OrderController@store')->name('order-store');
    Route::get('/order/edit/{id}', 'OrderController@edit')->name('order-edit');
    Route::get('/order/show/{id}', 'OrderController@show')->name('order-show');
    Route::get('/order/destroy/{id}', 'OrderController@destroy')->name('order-destroy');
    Route::post('/order/update', 'OrderController@update')->name('order-update');
    Route::post('/order/update-status', 'OrderController@updateStatus')->name('order-update-status');
    Route::post('/order/discount/store', 'OrderController@discount')->name('order-discount-store');
    Route::get('/order/next/confirm/{id}', 'OrderController@nextConfirm')->name('order-next-confirm');
    Route::get('/order/confirm/{id}', 'OrderController@orderConfirm')->name('order-confirm');
    Route::get('/order/next/finish/{id}', 'OrderController@nextFinish')->name('order-next-finish');

    //order item
    Route::post('/order-item/search', 'OrderItemController@search')->name('order-item-search');
    Route::post('/order-item/store', 'OrderItemController@store')->name('order-item-store');
    Route::post('/order-item/destroy', 'OrderItemController@destroy')->name('order-item-destroy');
    Route::get('/order-item/get/{id}', 'OrderItemController@get')->name('order-item-get');

    //order payment
    Route::get('/order-payment/{id}', 'OrderPaymentController@payment')->name('order-payment');
    Route::get('/order-next-payment-confirm/{id}', 'OrderPaymentController@paymentConfirm')->name('order-next-payment-confirm');
    Route::post('/order-payment/store', 'OrderPaymentController@store')->name('order-payment-store');



    //newsletter
    Route::get('/newsletters', 'NewsletterController@index')->name('newsletters');
    Route::get('/datatable-newsletters', 'NewsletterController@getDatatable')->name('datatable-newsletters');

    //document
    Route::get('/documents', 'DocumentController@index')->name('documents');
    Route::get('/datatable-documents', 'DocumentController@getDatatable')->name('datatable-documents');
    Route::get('/document/create', 'DocumentController@create')->name('document-create');
    Route::post('/document/store', 'DocumentController@store')->name('document-store');
    Route::get('/document/edit/{id}', 'DocumentController@edit')->name('document-edit');
    Route::get('/document/destroy/{id}', 'DocumentController@destroy')->name('document-destroy');
    Route::post('/document/update', 'DocumentController@update')->name('document-update');
    Route::get('/document/download/{file}', 'DocumentController@download')->name('document-download');
    Route::get('/document/destroy/file/{id}', 'DocumentController@destroyFile')->name('document-destroy-file');

    //banner
    Route::get('/banners', 'BannerController@index')->name('banners');
    Route::get('/datatable-banners', 'BannerController@getDatatable')->name('datatable-banners');
    Route::get('/banner/create', 'BannerController@create')->name('banner-create');
    Route::post('/banner/store', 'BannerController@store')->name('banner-store');
    Route::get('/banner/edit/{id}', 'BannerController@edit')->name('banner-edit');
    Route::get('/banner/destroy/{id}', 'BannerController@destroy')->name('banner-destroy');
    Route::post('/banner/update', 'BannerController@update')->name('banner-update');
    Route::get('/banner/download/{file}', 'BannerController@download')->name('banner-download');
    Route::get('/banner/destroy/file/{id}', 'BannerController@destroyFile')->name('banner-destroy-file');

    //page
    Route::get('/pages', 'PageController@index')->name('pages');
    Route::get('/datatable-pages', 'PageController@getDatatable')->name('datatable-pages');
    Route::get('/page/edit/{id}', 'PageController@edit')->name('page-edit');
    Route::post('/page/update', 'PageController@update')->name('page-update');
    Route::get('/page/destroy/{id}', 'PageController@destroy')->name('page-destroy');
    Route::get('/page/destroy/file/{id}', 'PageController@destroyFile')->name('page-destroy-file');


    //midia
    Route::get('/midias', 'MidiaController@index')->name('midias');
    Route::get('/datatable-midias', 'MidiaController@getDatatable')->name('datatable-midias');
    Route::get('/midia/create', 'MidiaController@create')->name('midia-create');
    Route::post('/midia/store', 'MidiaController@store')->name('midia-store');
    Route::get('/midia/edit/{id}', 'MidiaController@edit')->name('midia-edit');
    Route::get('/midia/destroy/{id}', 'MidiaController@destroy')->name('midia-destroy');
    Route::post('/midia/update', 'MidiaController@update')->name('midia-update');
    Route::get('/midia/download/{file}', 'MidiaController@download')->name('midia-download');
    Route::get('/midia/destroy/file/{id}', 'MidiaController@destroyFile')->name('midia-destroy-file');
    Route::post('/midia/modal', 'MidiaController@modal')->name('midia-modal');
});
