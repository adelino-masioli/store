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
    public static function createComplement($request, $user_id)
    {
        $user_complement_count = UserComplement::where('user_id', $user_id->id);
        if($user_complement_count->count() > 0){
            $array = [
                'company'    => $request->company ? $request->company : null,
                'zipcode'    => $request->zipcode,
                'address'    => $request->address,
                'district'   => $request->district,
                'number'     => $request->number,
                'state'      => $request->state,
                'city'       => $request->city,
                'phone'      => $request->phone,
                'cellphone'  => $request->cellphone,
                'user_id'    => $user_id->id,
                'status_id'  => statusOrder('active')
            ];
            $user_complement_count->first()->update($array);
        }else{
            $array = [
                'company'    => $request->company ? $request->company : null,
                'zipcode'    => $request->zipcode,
                'address'    => $request->address,
                'district'   => $request->district,
                'number'     => $request->number,
                'state'      => $request->state,
                'city'       => $request->city,
                'phone'      => $request->phone,
                'cellphone'  => $request->cellphone,
                'user_id'    => $user_id->id,
                'status_id'  => statusOrder('active')
            ];
            UserComplement::create($array);
        }
    }

}