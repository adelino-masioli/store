<?php
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //order
    Route::get('orders', [
        'uses' => 'OrderController@index',
        'as' => 'orders',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('/datatable-orders', 'OrderController@getDatatable')->name('datatable-orders');
    Route::get('order/create', [
        'uses' => 'OrderController@create',
        'as' => 'order-create',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('order/edit/{id}', [
        'uses' => 'OrderController@edit',
        'as' => 'order-edit',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('order/show/{id}', [
        'uses' => 'OrderController@show',
        'as' => 'order-show',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('order/destroy/{id}', [
        'uses' => 'OrderController@destroy',
        'as' => 'order-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('order/next/confirm/{id}', [
        'uses' => 'OrderController@nextConfirm',
        'as' => 'order-next-confirm',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('order/next/confirm/{id}', [
        'uses' => 'OrderController@nextConfirm',
        'as' => 'order-next-confirm',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('order/confirm/{id}', [
        'uses' => 'OrderController@orderConfirm',
        'as' => 'order-confirm',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('order/next/finish/{id}', [
        'uses' => 'OrderController@nextFinish',
        'as' => 'order-next-finish',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::post('/order/store', 'OrderController@store')->name('order-store');
    Route::post('/order/update', 'OrderController@update')->name('order-update');
    Route::post('/order/update-status', 'OrderController@updateStatus')->name('order-update-status');
    Route::post('/order/discount/store', 'OrderController@discount')->name('order-discount-store');

    //financial
    Route::get('orders-financial', [
        'uses' => 'FinancialController@index',
        'as' => 'orders-financial',
        'middleware' => 'roles',
        'roles' => permission_level_finance()
    ]);
    Route::get('/datatable-orders-financial', 'FinancialController@getDatatable')->name('datatable-orders-financial');
    Route::get('order/financial/show/{id}', [
        'uses' => 'FinancialController@show',
        'as' => 'order-financial-show',
        'middleware' => 'roles',
        'roles' => permission_level_finance()
    ]);

    //order item
    Route::post('/order-item/search', 'OrderItemController@search')->name('order-item-search');
    Route::post('/order-item/store', 'OrderItemController@store')->name('order-item-store');
    Route::post('/order-item/destroy', 'OrderItemController@destroy')->name('order-item-destroy');
    Route::get('/order-item/get/{id}', 'OrderItemController@get')->name('order-item-get');

    //order payment
    Route::get('order-payment/{id}', [
        'uses'       =>'OrderPaymentController@payment',
        'as'         =>'quote-payment',
        'middleware' => 'roles',
        'roles'      => permission_level_finance()
    ]);
    Route::get('order-next-payment-confirm/{id}', [
        'uses'       =>'OrderPaymentController@paymentConfirm',
        'as'         =>'order-next-payment-confirm',
        'middleware' => 'roles',
        'roles'      => permission_level_finance()
    ]);
    Route::post('/order-payment/store', 'OrderPaymentController@store')->name('order-payment-store');
});