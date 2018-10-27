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
        'roles' => permission_level_four()
    ]);
    Route::get('contact/note/{id}', [
        'uses' => 'ContactNoteController@index',
        'as' => 'contact-note-get',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('contact/attachment/{id}', [
        'uses' => 'ContactAttachmentController@index',
        'as' => 'contact-attachment-get',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('contact/download/{id}', [
        'uses' => 'ContactAttachmentController@download',
        'as' => 'contact-attachment-download',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('contact/quote/index', [
        'uses' => 'ContactQuoteController@index',
        'as' => 'contact-quote-index',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('contact/quote/{id}', [
        'uses' => 'ContactQuoteController@get',
        'as' => 'contact-quote-get',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::get('contact/quote/pdf/{id}', [
        'uses' => 'ContactQuoteController@pdf',
        'as' => 'contact-quote-pdf',
        'middleware' => 'roles',
        'roles' => permission_level_four()
    ]);
    Route::post('/contact/store', 'ContactController@store')->name('contact-store');
    Route::post('/contact/update', 'ContactController@update')->name('contact-update');
    Route::post('/contact/none/store', 'ContactNoteController@store')->name('contact-note-store');
    Route::post('/contact/none/update', 'ContactNoteController@update')->name('contact-note-update');
    Route::post('/contact/none/destroy', 'ContactNoteController@destroy')->name('contact-note-destroy');
    Route::post('/contact/attachment/store', 'ContactAttachmentController@store')->name('contact-attachment-store');
    Route::post('/contact/attachment/update', 'ContactAttachmentController@update')->name('contact-attachment-update');
    Route::post('/contact/attachment/destroy', 'ContactAttachmentController@destroy')->name('contact-attachment-destroy');
    Route::post('/contact/quote/store', 'ContactQuoteController@store')->name('quote-item-store');
    Route::post('/contact/quote/remove', 'ContactQuoteController@remove')->name('quote-item-remove');
    Route::post('/contact/quote/discount', 'ContactQuoteController@discount')->name('quote-item-discount');
    Route::post('/contact/quote/cancel', 'ContactQuoteController@cancel')->name('quote-item-cancel');
    Route::post('/contact/quote/finish', 'ContactQuoteController@finish')->name('quote-item-finish');
    Route::post('/contact/quote/status', 'ContactQuoteController@status')->name('quote-status');
    Route::post('/contact/quote/email', 'ContactQuoteController@sendMail')->name('quote-send-email');
});