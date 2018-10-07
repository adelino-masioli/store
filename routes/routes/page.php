<?php
Route::middleware(['auth', 'checkstatus', 'suspended'])->namespace('Admin')->prefix('admin')->group(function () {
    //page
    Route::get('pages', [
        'uses' => 'PageController@index',
        'as' => 'pages',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('/datatable-pages', 'PageController@getDatatable')->name('datatable-pages');
    Route::get('page/edit/{id}', [
        'uses' => 'PageController@edit',
        'as' => 'page-edit',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('page/destroy/{id}', [
        'uses' => 'PageController@destroy',
        'as' => 'page-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::get('page/destroy/file/{id}', [
        'uses' => 'PageController@destroyFile',
        'as' => 'page-destroy-file',
        'middleware' => 'roles',
        'roles' => permission_level_two()
    ]);
    Route::post('/page/update', 'PageController@update')->name('page-update');
});