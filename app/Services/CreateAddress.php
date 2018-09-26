<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/26/2018
 * Time: 14:48
 */

namespace App\Services;


use App\Models\UserComplement;

class CreateAddress
{
    public static function createComplement($request)
    {
        $user_complement_count = UserComplement::where('user_id', $request->id);
        if($user_complement_count->count() > 0){
            $array = [
                'zipcode'    => $request->zipcode,
                'address'    => $request->address,
                'district'   => $request->district,
                'number'     => $request->number,
                'state'      => $request->state,
                'city'       => $request->city,
                'phone'      => $request->phone,
                'cellphone'  => $request->cellphone,
                'user_id'    => $request->id,
                'status_id'  => 1
            ];
            $user_complement_count->first()->update($array);
        }else{
            $array = [
                'zipcode'    => $request->zipcode,
                'address'    => $request->address,
                'district'   => $request->district,
                'number'     => $request->number,
                'state'      => $request->state,
                'city'       => $request->city,
                'phone'      => $request->phone,
                'cellphone'  => $request->cellphone,
                'user_id'    => $request->id,
                'status_id'  => 1
            ];
            UserComplement::create($array);
        }
    }

}