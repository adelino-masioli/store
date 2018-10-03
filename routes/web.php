<?php

require_once('routes/site.php');


Auth::routes();
//Route::get('/register', function (){
//   return bcrypt("123456");
//});

require_once('routes/configuration.php');
require_once('routes/user.php');
require_once('routes/product.php');
require_once('routes/contact.php');
require_once('routes/order.php');
require_once('routes/quote.php');
require_once('routes/document.php');
require_once('routes/banner.php');
require_once('routes/page.php');
require_once('routes/midia.php');

//admin products
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/register', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //newsletter
    Route::get('newsletters', [
        'uses'       =>'NewsletterController@index',
        'as'         =>'newsletters',
        'middleware' => 'roles',
        'roles'      => permission_level_three()
    ]);
    Route::get('/datatable-newsletters', 'NewsletterController@getDatatable')->name('datatable-newsletters');

    //401
    Route::get('/401', function (){
        return view('admin.error.401');
    });
});