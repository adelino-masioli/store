<?php
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //document
    Route::get('documents', [
        'uses' => 'DocumentController@index',
        'as' => 'documents',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('/datatable-documents', 'DocumentController@getDatatable')->name('datatable-documents');
    Route::get('document/create', [
        'uses' => 'DocumentController@create',
        'as' => 'document-create',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('document/create', [
        'uses' => 'DocumentController@create',
        'as' => 'document-create',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('document/edit/{id}', [
        'uses' => 'DocumentController@edit',
        'as' => 'document-edit',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('document/destroy/{id}', [
        'uses' => 'DocumentController@destroy',
        'as' => 'document-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('document/download/{file}', [
        'uses' => 'DocumentController@download',
        'as' => 'document-download',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('document/destroy/file/{id}', [
        'uses' => 'DocumentController@destroyFile',
        'as' => 'document-destroy-file',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::post('/document/store', 'DocumentController@store')->name('document-store');
    Route::post('/document/update', 'DocumentController@update')->name('document-update');
});