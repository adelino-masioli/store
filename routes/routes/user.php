<?php
Route::middleware(['auth', 'checkstatus', 'suspended'])->namespace('Admin')->prefix('admin')->group(function () {
    //user
    Route::get('me', [
        'uses' => 'UserController@me',
        'as' => 'me',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);
    Route::get('users', [
        'uses' => 'UserController@index',
        'as' => 'users',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('/datatable-users', 'UserController@getDatatable')->name('datatable-users');
    Route::get('user/create', [
        'uses' => 'UserController@create',
        'as' => 'user-create',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('user/edit/{id}', [
        'uses' => 'UserController@edit',
        'as' => 'user-edit',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('user/destroy/{id}', [
        'uses' => 'UserController@destroy',
        'as' => 'user-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('user/avatar-destroy/{id}', [
        'uses' => 'UserController@destroyAvatar',
        'as' => 'user-avatar-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_seven()
    ]);
    Route::post('/user/store', 'UserController@store')->name('user-store');
    Route::post('/user/update', 'UserController@update')->name('user-update');
    Route::post('/user/avatar', 'UserController@updateAvatar')->name('user-avatar');
    Route::post('/user/search', 'UserController@search')->name('user-search');
});