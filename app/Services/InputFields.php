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

}