<?php
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //product
    Route::get('products', [
        'uses' => 'ProductController@index',
        'as' => 'products',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('/datatable-products', 'ProductController@getDatatable')->name('datatable-products');
    Route::get('product/create', [
        'uses' => 'ProductController@create',
        'as' => 'product-create',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('product/edit/{id}', [
        'uses' => 'ProductController@edit',
        'as' => 'product-edit',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('product/destroy/{id}', [
        'uses' => 'ProductController@destroy',
        'as' => 'product-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::post('/product/store', 'ProductController@store')->name('product-store');
    Route::post('/product/update', 'ProductController@update')->name('product-update');
    Route::post('/product/category', 'ProductController@productCategory')->name('product-category');
    Route::post('/product/subcategory', 'ProductController@producSubCategory')->name('product-subcategory');
    Route::post('/product/image/store', 'ProductImageController@store')->name('product-image-store');
    Route::get('product/image/destroy/{id}', [
        'uses' => 'ProductImageController@destroy',
        'as' => 'product-image-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);

    //category
    Route::get('categories', [
        'uses' => 'CategoryController@index',
        'as' => 'categories',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('/datatable-categories', 'CategoryController@getDatatable')->name('datatable-categories');
    Route::get('category/create', [
        'uses' => 'CategoryController@create',
        'as' => 'category-create',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('category/edit/{id}', [
        'uses' => 'CategoryController@edit',
        'as' => 'category-edit',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('category/destroy/{id}', [
        'uses' => 'CategoryController@destroy',
        'as' => 'category-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::post('/category/store', 'CategoryController@store')->name('category-store');
    Route::post('/category/update', 'CategoryController@update')->name('category-update');

    //subcategory
    Route::get('subcategories', [
        'uses' => 'SubCategoryController@index',
        'as' => 'subcategories',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('/datatable-subcategories', 'SubCategoryController@getDatatable')->name('datatable-subcategories');
    Route::get('subcategory/create', [
        'uses' => 'SubCategoryController@create',
        'as' => 'subcategory-create',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('subcategory/edit/{id}', [
        'uses' => 'SubCategoryController@edit',
        'as' => 'subcategory-edit',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('subcategory/destroy/{id}', [
        'uses' => 'SubCategoryController@destroy',
        'as' => 'subcategory-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::post('/subcategory/store', 'SubCategoryController@store')->name('subcategory-store');
    Route::post('/subcategory/update', 'SubCategoryController@update')->name('subcategory-update');
});