<?php
Route::middleware(['auth', 'checkstatus', 'suspended'])->namespace('Admin')->prefix('admin')->group(function () {
    //quote
    Route::get('quotes', [
        'uses' => 'OrderController@indexQuote',
        'as' => 'quotes',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('/datatable-quotes', 'OrderController@getDatatableQuope')->name('datatable-quotes');
    Route::get('quote/show/{id}', [
        'uses' => 'OrderController@quoteShow',
        'as' => 'quote-show',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('quote/cancel/{id}', [
        'uses' => 'OrderController@quoteCancel',
        'as' => 'quote-cancel',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('quote/convert/{id}', [
        'uses' => 'OrderController@quoteConvert',
        'as' => 'quote-convert',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::post('/quote/update', 'OrderController@update')->name('quote-update');
});