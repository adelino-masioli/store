<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/16/2018
 * Time: 23:13
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Models\Configuration;


class ConfigurationComposer
{

    public function compose(View $view)
    {
        $configuration = Configuration::take(1)->first();
        $view->with('configuration', $configuration);
    }

}