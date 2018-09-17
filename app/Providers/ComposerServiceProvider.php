<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/16/2018
 * Time: 23:16
 */

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Using class based composers...
        View::composer(
            'configuration', 'App\Http\ViewComposers\ConfigurationComposer'
        );

        View::composer('*', function ($view) {
            $view->with('configuration', Configuration::take(1)->first());
        });

    }


    public function register()
    {
        //
    }

}