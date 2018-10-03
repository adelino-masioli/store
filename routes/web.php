<?php

require_once('routes/site.php');


Auth::routes();
Route::get('register', function (){
    return redirect('/login');
});
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
require_once('routes/support.php');


//401
Route::get('/error/401', function (){
    return view('admin.error.401');
});
//admin
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //newsletter
    Route::get('newsletters', [
        'uses'       =>'NewsletterController@index',
        'as'         =>'newsletters',
        'middleware' => 'roles',
        'roles'      => permission_level_four()
    ]);
    Route::get('/datatable-newsletters', 'NewsletterController@getDatatable')->name('datatable-newsletters');
});

//customers
require_once('routes/customer/dashboard.php');
require_once('routes/customer/document.php');
require_once('routes/customer/support.php');