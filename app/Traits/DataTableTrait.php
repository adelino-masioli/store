<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/26/2018
 * Time: 10:59
 */
namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait DataTableTrait
{
    public function dataTable($model=null, $columns=[])
    {
        $profile = Auth::user()->type_id;
        if($profile == 1){
            $result = $model->select($columns)->where('status_id', '!=', 3);
        }else{
            $result = $model->select($columns)->where('configuration_id', Auth::user()->configuration_id)->where('status_id', '!=', 3);
        }
        return $result;
    }
}