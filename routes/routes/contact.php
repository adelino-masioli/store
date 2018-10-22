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
    Route::get('contact/create', [
        'uses' => 'ContactController@create',
        'as' => 'contact-create',
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
    Route::get('contact/note/{id}', [
        'uses' => 'ContactNoteController@index',
        'as' => 'contact-note-get',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('contact/attachment/{id}', [
        'uses' => 'ContactAttachmentController@index',
        'as' => 'contact-attachment-get',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('contact/download/{id}', [
        'uses' => 'ContactAttachmentController@download',
        'as' => 'contact-attachment-download',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::post('/contact/store', 'ContactController@store')->name('contact-store');
    Route::post('/contact/update', 'ContactController@update')->name('contact-update');
    Route::post('/contact/none/store', 'ContactNoteController@store')->name('contact-note-store');
    Route::post('/contact/none/update', 'ContactNoteController@update')->name('contact-note-update');
    Route::post('/contact/none/destroy', 'ContactNoteController@destroy')->name('contact-note-destroy');
    Route::post('/contact/attachment/store', 'ContactAttachmentController@store')->name('contact-attachment-store');
    Route::post('/contact/attachment/update', 'ContactAttachmentController@update')->name('contact-attachment-update');
    Route::post('/contact/attachment/destroy', 'ContactAttachmentController@destroy')->name('contact-attachment-destroy');
});