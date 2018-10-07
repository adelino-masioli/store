<?php
Route::middleware(['auth', 'checkstatus', 'suspended'])->namespace('Admin')->prefix('admin')->group(function () {
    //midia
    Route::get('midias', [
        'uses'       =>'MidiaController@index',
        'as'         =>'midias',
        'middleware' => 'roles',
        'roles'      => permission_level_two()
    ]);
    Route::get('/datatable-midias', 'MidiaController@getDatatable')->name('datatable-midias');
    Route::get('midia/create', [
        'uses'       =>'MidiaController@create',
        'as'         =>'midia-create',
        'middleware' => 'roles',
        'roles'      => permission_level_two()
    ]);
    Route::get('midia/edit/{id}', [
        'uses'       =>'MidiaController@edit',
        'as'         =>'midia-edit',
        'middleware' => 'roles',
        'roles'      => permission_level_two()
    ]);
    Route::get('midia/destroy/{id}', [
        'uses'       =>'MidiaController@destroy',
        'as'         =>'midia-destroy',
        'middleware' => 'roles',
        'roles'      => permission_level_two()
    ]);
    Route::get('midia/download/{file}', [
        'uses'       =>'MidiaController@download',
        'as'         =>'midia-download',
        'middleware' => 'roles',
        'roles'      => permission_level_two()
    ]);
    Route::get('midia/destroy/file/{id}', [
        'uses'       =>'MidiaController@destroyFile',
        'as'         =>'midia-destroy-file',
        'middleware' => 'roles',
        'roles'      => permission_level_two()
    ]);
    Route::post('/midia/store', 'MidiaController@store')->name('midia-store');
    Route::post('/midia/update', 'MidiaController@update')->name('midia-update');
    Route::post('/midia/modal', 'MidiaController@modal')->name('midia-modal');
});