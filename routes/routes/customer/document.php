<?php
Route::middleware(['auth'])->namespace('Customer')->prefix('customer')->group(function () {
    //documents
    Route::get('documents/{type}', [
        'uses' => 'DocumentController@index',
        'as' => 'customer-documents',
        'middleware' => 'roles',
        'roles' => permission_level_five()
    ]);
    Route::get('/datatable-documents/{type_id}', 'DocumentController@getDatatable')->name('datatable-customer-documents');
    Route::get('document/show/{file}', [
        'uses' => 'DocumentController@show',
        'as' => 'customer-document-show',
        'middleware' => 'roles',
        'roles' => permission_level_five()
    ]);
    Route::get('document/download/{file}', [
        'uses' => 'DocumentController@download',
        'as' => 'customer-document-download',
        'middleware' => 'roles',
        'roles' => permission_level_five()
    ]);
});