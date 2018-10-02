<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/16/2018
 * Time: 23:13
 */
namespace App\Http\ViewComposers;
use App\Services\ConfigurationSite;
use Illuminate\View\View;
class ConfigurationComposer
{
    public function compose(View $view)
    {
        $configuration = ConfigurationSite::getConfiguration();
        $view->with('configuration', $configuration);
    }
}