<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 10/2/2018
 * Time: 09:15
 */

namespace App\Services;
use App\Models\Configuration;

class ConfigurationSite
{
    public static function getConfiguration()
    {
        $configuration_site = Configuration::where('url', url('/'))->orWhere('url_security', url()->current())->take(1)->first();
        if($configuration_site){
            return $configuration_site;
        }else {
            return null;
        }
    }
}