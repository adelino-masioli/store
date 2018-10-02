<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/16/2018
 * Time: 23:16
 */

namespace App\Providers;

use App\Services\ConfigurationSite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Using class based composers...
        View::composer(
            'config_site', 'App\Http\ViewComposers\ConfigurationComposer'
        );

        View::composer('*', function ($view) {
            $view->with('config_site', ConfigurationSite::getConfiguration());
        });

    }


    public function register()
    {
        //
    }

}