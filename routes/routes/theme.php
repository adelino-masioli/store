<?php
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->group(function () {
    //document
    Route::get('themes', [
        'uses' => 'ThemeController@index',
        'as' => 'themes',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
    Route::get('theme/update/{configuration}/{theme}', [
        'uses' => 'ThemeController@update',
        'as' => 'theme-update',
        'middleware' => 'roles',
        'roles' => permission_level_three()
    ]);
});