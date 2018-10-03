<?php
Route::middleware(['auth'])->namespace('Customer')->prefix('customer')->group(function () {
    //support
    Route::get('supports', [
        'uses' => 'SupportController@index',
        'as' => 'customer-supports',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::get('/datatable-supports', 'SupportController@getDatatable')->name('datatable-customer-supports');
    Route::get('support/create', [
        'uses' => 'SupportController@create',
        'as' => 'customer-support-create',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::get('support/store', [
        'uses' => 'SupportController@store',
        'as' => 'customer-support-store',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::get('support/edit/{id}', [
        'uses' => 'SupportController@edit',
        'as' => 'customer-support-edit',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::get('support/show/{id}', [
        'uses' => 'SupportController@show',
        'as' => 'customer-support-show',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::get('support/destroy/{id}', [
        'uses' => 'SupportController@destroy',
        'as' => 'customer-support-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::get('support/download/{file}', [
        'uses' => 'SupportController@download',
        'as' => 'customer-support-download',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::get('support/destroy/file/{id}', [
        'uses' => 'SupportController@destroyFile',
        'as' => 'customer-support-destroy-file',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::get('support/close/{id}', [
        'uses' => 'SupportController@close',
        'as' => 'customer-support-close',
        'middleware' => 'roles',
        'roles' => permission_level_eight()
    ]);
    Route::post('/support/store', 'SupportController@store')->name('customer-support-store');
    Route::post('/support/store/answer', 'SupportController@answer')->name('customer-support-answer');
    Route::post('/support/update', 'SupportController@update')->name('customer-support-update');
});