<?php
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //order
    Route::get('orders', [
        'uses' => 'OrderController@index',
        'as' => 'orders',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('/datatable-orders', 'OrderController@getDatatable')->name('datatable-orders');
    Route::get('order/create', [
        'uses' => 'OrderController@create',
        'as' => 'order-create',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('order/edit/{id}', [
        'uses' => 'OrderController@edit',
        'as' => 'order-edit',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('order/show/{id}', [
        'uses' => 'OrderController@show',
        'as' => 'order-show',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('order/destroy/{id}', [
        'uses' => 'OrderController@destroy',
        'as' => 'order-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('order/next/confirm/{id}', [
        'uses' => 'OrderController@nextConfirm',
        'as' => 'order-next-confirm',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('order/next/confirm/{id}', [
        'uses' => 'OrderController@nextConfirm',
        'as' => 'order-next-confirm',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('order/confirm/{id}', [
        'uses' => 'OrderController@orderConfirm',
        'as' => 'order-confirm',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('order/next/finish/{id}', [
        'uses' => 'OrderController@nextFinish',
        'as' => 'order-next-finish',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::post('/order/store', 'OrderController@store')->name('order-store');
    Route::post('/order/update', 'OrderController@update')->name('order-update');
    Route::post('/order/update-status', 'OrderController@updateStatus')->name('order-update-status');
    Route::post('/order/discount/store', 'OrderController@discount')->name('order-discount-store');


    //order item
    Route::post('/order-item/search', 'OrderItemController@search')->name('order-item-search');
    Route::post('/order-item/store', 'OrderItemController@store')->name('order-item-store');
    Route::post('/order-item/destroy', 'OrderItemController@destroy')->name('order-item-destroy');
    Route::get('/order-item/get/{id}', 'OrderItemController@get')->name('order-item-get');

    //order payment
    Route::get('order-payment/{id}', [
        'uses'       =>'OrderPaymentController@payment',
        'as'         =>'order-payment',
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
    Route::post('/order-payment/destroy', 'OrderPaymentController@destroy')->name('order-payment-destroy');


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
    //report
    Route::get('order/financial/report', [
        'uses' => 'FinancialController@report',
        'as' => 'orders-financial-report',
        'middleware' => 'roles',
        'roles' => permission_level_finance()
    ]);
    Route::post('order/financial/report/filter', [
        'uses' => 'FinancialController@filter',
        'as' => 'order-financial-report-filter',
        'middleware' => 'roles',
        'roles' => permission_level_finance()
    ]);
    Route::get('order/financial/report/print', [
        'uses' => 'FinancialController@print',
        'as' => 'orders-financial-report-print',
        'middleware' => 'roles',
        'roles' => permission_level_finance()
    ]);


    //production
    Route::get('orders-production', [
        'uses' => 'ProductionController@index',
        'as' => 'orders-production',
        'middleware' => 'roles',
        'roles' => permission_level_six()
    ]);
    Route::get('/datatable-orders-production', 'ProductionController@getDatatable')->name('datatable-orders-production');
    Route::get('order/production/show/{id}', [
        'uses' => 'ProductionController@show',
        'as' => 'order-production-show',
        'middleware' => 'roles',
        'roles' => permission_level_six()
    ]);
    Route::get('order/production/confirm/{id}', [
        'uses' => 'ProductionController@confirm',
        'as' => 'orders-production-confirm',
        'middleware' => 'roles',
        'roles' => permission_level_six()
    ]);

    //expedition
    Route::get('orders-expedition', [
        'uses' => 'ExpeditionController@index',
        'as' => 'orders-expedition',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);
    Route::get('/datatable-orders-expedition', 'ExpeditionController@getDatatable')->name('datatable-orders-expedition');
    Route::get('order/expedition/show/{id}', [
        'uses' => 'ExpeditionController@show',
        'as' => 'order-expedition-show',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);
    Route::get('order/expedition/conference/{id}', [
        'uses' => 'ExpeditionController@conference',
        'as' => 'orders-expedition-conference',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);
    Route::get('order/expedition/confirm/{id}', [
        'uses' => 'ExpeditionController@confirm',
        'as' => 'orders-expedition-confirm',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);


    //order annotation
    Route::get('order-annotation/{id}', [
        'uses'       =>'OrderAnnotationController@list',
        'as'         =>'order-annotation',
        'middleware' => 'roles',
        'roles'      => permission_level_seven()
    ]);
    Route::get('order-annotation-open/{id}', [
        'uses'       =>'OrderAnnotationController@open',
        'as'         =>'order-annotation-open',
        'middleware' => 'roles',
        'roles'      => permission_level_seven()
    ]);
    Route::get('order-annotation-destroy/{id}', [
        'uses'       =>'OrderAnnotationController@destroy',
        'as'         =>'order-annotation-destroy',
        'middleware' => 'roles',
        'roles'      => permission_level_seven()
    ]);
    Route::post('/order-annotation/store', 'OrderAnnotationController@store')->name('order-annotation-store');


    //order timeline
    Route::get('order-timeline', [
        'uses'       =>'OrderTimelineController@all',
        'as'         =>'order-timeline',
        'middleware' => 'roles',
        'roles'      => permission_level_seven()
    ]);

    //order timeline
    Route::get('order-timeline-show/{order}', [
        'uses'       =>'OrderTimelineController@show',
        'as'         =>'order-timeline-show',
        'middleware' => 'roles',
        'roles'      => permission_level_seven()
    ]);


    //print
    Route::get('order/print/{id}', [
        'uses' => 'OrderController@print',
        'as' => 'order-print',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);
});