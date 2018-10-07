<?php
Route::middleware(['auth', 'checkstatus', 'suspended'])->namespace('Admin')->prefix('admin')->group(function () {
    //contact
    Route::get('contacts', [
        'uses' => 'ContactController@index',
        'as' => 'contacts',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('/datatable-contacts', 'ContactController@getDatatable')->name('datatable-contacts');
    Route::get('contacts', [
        'uses' => 'ContactController@index',
        'as' => 'contacts',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('contact/edit/{id}', [
        'uses' => 'ContactController@edit',
        'as' => 'contact-edit',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('contact/destroy/{id}', [
        'uses' => 'ContactController@destroy',
        'as' => 'contact-destroy',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::post('/contact/update', 'ContactController@update')->name('contact-update');
});