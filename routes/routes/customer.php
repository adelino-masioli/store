<?php
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //customer
    Route::get('customer/me', [
        'uses' => 'CustomerController@me',
        'as' => 'me',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);
    Route::get('customers', [
        'uses' => 'CustomerController@index',
        'as' => 'customers',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('/datatable-customers', 'CustomerController@getDatatable')->name('datatable-customers');
    Route::get('customer/create', [
        'uses' => 'CustomerController@create',
        'as' => 'customer-create',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('customer/edit/{id}', [
        'uses' => 'CustomerController@edit',
        'as' => 'customer-edit',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('customer/destroy/{id}', [
        'uses' => 'CustomerController@destroy',
        'as' => 'customer-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('customer/avatar-destroy/{id}', [
        'uses' => 'CustomerController@destroyAvatar',
        'as' => 'customer-avatar-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);
    Route::post('/customer/store', 'CustomerController@store')->name('customer-store');
    Route::post('/customer/update', 'CustomerController@update')->name('customer-update');
    Route::post('/customer/avatar', 'CustomerController@updateAvatar')->name('customer-avatar');
    Route::post('/customer/search', 'CustomerController@search')->name('customer-search');
});