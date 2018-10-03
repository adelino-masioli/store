<?php
Route::middleware(['auth'])->namespace('Customer')->prefix('customer')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('customer-dashboard');

    //401
    Route::get('/401', function (){
        return view('customer.error.401');
    });
});