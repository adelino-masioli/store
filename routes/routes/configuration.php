<?php
Route::middleware(['auth', 'checkstatus', 'suspended'])->namespace('Admin')->prefix('admin')->group(function () {
    //configuration
    Route::get('configuration', [
        'uses' => 'ConfigurationController@myConfig',
        'as' => 'configuration',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('configurations', [
        'uses' => 'ConfigurationController@index',
        'as' => 'configurations',
        'middleware' => 'roles',
        'roles' => permission_level_one()
    ]);
    Route::get('datatable-configurations', 'ConfigurationController@getDatatable')->name('datatable-configurations');
    Route::get('configuration/create', [
        'uses' => 'ConfigurationController@create',
        'as' => 'configuration-create',
        'middleware' => 'roles',
        'roles' => permission_level_one()
    ]);
    Route::get('configuration/edit/{id}', [
        'uses' => 'ConfigurationController@edit',
        'as' => 'configuration-edit',
        'middleware' => 'roles',
        'roles' => permission_level_one()
    ]);
    Route::get('configuration/destroy/{id}', [
        'uses' => 'ConfigurationController@destroy',
        'as' => 'configuration-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_one()
    ]);
    Route::get('configuration/brand-destroy/{id}', [
        'uses' => 'ConfigurationController@destroyBrand',
        'as' => 'configuration-brand-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::post('/configuration/store', 'ConfigurationController@store')->name('configuration-store');
    Route::post('/configuration/update', 'ConfigurationController@update')->name('configuration-update');
    Route::post('/configuration/brand', 'ConfigurationController@updateBrand')->name('configuration-brand');
});