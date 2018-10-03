<?php
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //support
    Route::get('supports', [
        'uses' => 'SupportController@index',
        'as' => 'supports',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('/datatable-supports', 'SupportController@getDatatable')->name('datatable-supports');
    Route::get('support/create', [
        'uses' => 'SupportController@create',
        'as' => 'support-create',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('support/store', [
        'uses' => 'SupportController@store',
        'as' => 'support-store',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('support/edit/{id}', [
        'uses' => 'SupportController@edit',
        'as' => 'support-edit',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('support/show/{id}', [
        'uses' => 'SupportController@show',
        'as' => 'support-show',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('support/destroy/{id}', [
        'uses' => 'SupportController@destroy',
        'as' => 'support-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('support/download/{file}', [
        'uses' => 'SupportController@download',
        'as' => 'support-download',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('support/destroy/file/{id}', [
        'uses' => 'SupportController@destroyFile',
        'as' => 'support-destroy-file',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('support/close/{id}', [
        'uses' => 'SupportController@close',
        'as' => 'support-close',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::post('/support/store', 'SupportController@store')->name('support-store');
    Route::post('/support/store/answer', 'SupportController@answer')->name('support-answer');
    Route::post('/support/update', 'SupportController@update')->name('support-update');
});