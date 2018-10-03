<?php
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //banner
    Route::get('banners', [
        'uses' => 'BannerController@index',
        'as' => 'banners',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('/datatable-banners', 'BannerController@getDatatable')->name('datatable-banners');
    Route::get('banner/create', [
        'uses' => 'BannerController@create',
        'as' => 'banner-create',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('banner/edit/{id}', [
        'uses' => 'BannerController@edit',
        'as' => 'banner-edit',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('banner/destroy/{id}', [
        'uses' => 'BannerController@destroy',
        'as' => 'banner-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('banner/download/{file}', [
        'uses' => 'BannerController@download',
        'as' => 'banner-download',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('banner/destroy/file/{id}', [
        'uses' => 'BannerController@destroyFile',
        'as' => 'banner-destroy-file',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::post('/banner/store', 'BannerController@store')->name('banner-store');
    Route::post('/banner/update', 'BannerController@update')->name('banner-update');
});