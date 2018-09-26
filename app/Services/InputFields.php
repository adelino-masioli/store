<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/26/2018
 * Time: 09:42
 */

namespace App\Services;


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

}