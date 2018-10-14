<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 10/13/2018
 * Time: 19:22
 */

namespace App\Services;


class Rate
{
    public static function rate($rate=null)
    {
        if($rate != null){
            $rate_array = [];
            foreach ($rate as $rate){
                $rate_array[$rate->id] = $rate->rate;
            }
            $count=array_count_values($rate_array);

            $r1 = array_key_exists('1', $count) ? $count[1] : 0;
            $r2 = array_key_exists('2', $count) ? $count[2] : 0;
            $r3 = array_key_exists('3', $count) ? $count[3] : 0;
            $r4 = array_key_exists('4', $count) ? $count[4] : 0;
            $r5 = array_key_exists('5', $count) ? $count[5] : 0;

            $array_values = [
                'r1' => $r1,
                'r2' => $r2,
                'r3' => $r3,
                'r4' => $r4,
                'r5' => $r5,
            ];

            return array_keys($array_values, max($array_values));
        }
        return false;
    }

}