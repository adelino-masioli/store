<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/26/2018
 * Time: 09:42
 */

namespace App\Services;


use Illuminate\Support\Facades\Auth;

class InputFields
{
    public static function inputFieldsConfiguration($request){
        $fields = [
            'name'      => $request['name'],
            'contact'   => $request['contact'],
            'email'     => $request['email'],
            'phone'     => $request['phone'],
            'whatsapp'  => $request['whatsapp'],
            'about'     => $request['about'],
            'zipcode'   => $request['zipcode'],
            'address'   => $request['address'],
            'district'  => $request['district'],
            'number'    => $request['number'],
            'state'     => $request['state'],
            'city'      => $request['city'],
            'status_id' => $request['status_id']
        ];

        return $fields;
    }

    public static function inputFieldsUser($request){
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configuration_id = Auth::user()->configuration_id;
        }else{
            $configuration_id = $request['configuration_id'];
        }
        if($request['password']) {
            $fields = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'configuration_id' => $configuration_id,
                'type_id' => $request['type_id'],
                'status_id' => $request['status_id']
            ];
        }else{
            $fields = [
                'name' => $request['name'],
                'email' => $request['email'],
                'configuration_id' => $configuration_id,
                'type_id' => $request['type_id'],
                'status_id' => $request['status_id']
            ];
        }

        return $fields;
    }

    public static function inputFieldsCategory($request){
        $status = $request['status_id'] ? $request['status_id'] : 2;
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configuration_id = Auth::user()->configuration_id;
        }else{
            $configuration_id = $request['configuration_id'];
        }

        $fields = [
            'deep'               => 1,
            'name'               => $request['name'],
            'slug'               => str_slug($request['name'], '-'),
            'description'        => $request['description'],
            'status_id'          => $status,
            'configuration_id'   => $configuration_id
        ];

        return $fields;
    }


    public static function inputFieldsSubCategory($request){
        $status = $request['status_id'] ? $request['status_id'] : 2;
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configuration_id = Auth::user()->configuration_id;
        }else{
            $configuration_id = $request['configuration_id'];
        }

        $fields = [
            'deep'               => 2,
            'name'               => $request['name'],
            'slug'               => str_slug($request['name'], '-'),
            'description'        => $request['description'],
            'status_id'          => $status,
            'configuration_id'   => $configuration_id,
            'category_id'        => $request['category_id']
        ];

        return $fields;
    }


    public static function inputFieldsProduct($request){
        $status = $request['status_id'] ? $request['status_id'] : 2;
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configuration_id = Auth::user()->configuration_id;
        }else{
            $configuration_id = $request['configuration_id'];
        }

        $fields = [
            'sku'              => $request['sku'],
            'name'             => $request['name'],
            'slug'             => str_slug($request['product_name'], '-'),
            'description'      => $request['description'],
            'meta_title'       => $request['meta_title'],
            'meta_description' => $request['meta_description'],
            'meta_keyword'     => $request['meta_keyword'],
            'price'            => moneyReverse($request['price']),
            'qty'              => $request['qty'],
            'configuration_id' => $configuration_id,
            'status_id'        => $status
        ];

        return $fields;
    }


    public static function inputFieldsDocument($request, $extension, $size, $fileName){
        $status = $request['status_id'] ? $request['status_id'] : 5;
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configuration_id = Auth::user()->configuration_id;
        }else{
            $configuration_id = $request['configuration_id'];
        }

        if($extension == null || $size == null || $fileName == null) {
            $fields = [
                'name' => $request['name'],
                'description' => $request['description'],
                'type_id' => $request['type_id'],
                'configuration_id' => $configuration_id,
                'status_id' => $status
            ];
        }else{
            $fields = [
                'name' => $request['name'],
                'description' => $request['description'],
                'type_id' => $request['type_id'],
                'file' => $fileName,
                'extension' => $extension,
                'size' => $size,
                'date' => date('Y:m:d'),
                'time' => date('H:i:s'),
                'configuration_id' => $configuration_id,
                'status_id' => $status
            ];
        }

        return $fields;
    }


    public static function inputFieldsBanner($request, $extension, $size, $fileName){
        $status = $request['status_id'] ? $request['status_id'] : 2;
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configuration_id = Auth::user()->configuration_id;
        }else{
            $configuration_id = $request['configuration_id'];
        }

        if($extension == null || $size == null || $fileName == null) {
            $fields = [
                'name' => $request['name'],
                'description' => $request['description'],
                'configuration_id' => $configuration_id,
                'status_id' => $status
            ];
        }else{
            $fields = [
                'name' => $request['name'],
                'description' => $request['description'],
                'file' => $fileName,
                'extension' => $extension,
                'size' => $size,
                'configuration_id' => $configuration_id,
                'status_id' => $status
            ];
        }

        return $fields;
    }


    public static function inputFieldsQuote($request){
        $status = $request['status_id'] ? $request['status_id'] : 3;
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configuration_id = Auth::user()->configuration_id;
        }else{
            $configuration_id = $request['configuration_id'];
        }

        $fields = [
            'name'             => $request['name'],
            'email'            => $request['email'],
            'phone'            => $request['phone'],
            'about'            => $request['about'],
            'description'      => $request['description'],
            'total'            => $request['total'],
            'zipcode'          => $request['zipcode'],
            'address'          => $request['address'],
            'district'         => $request['district'],
            'number'           => $request['number'],
            'state'            => $request['state'],
            'city'             => $request['city'],
            'status_id'        => $status,
            'configuration_id' => $configuration_id
        ];

        return $fields;
    }

}