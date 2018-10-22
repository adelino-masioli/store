<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 10/20/2018
 * Time: 22:58
 */

namespace App\Traits;


use App\Models\ContactCompany;
use App\Models\ContactEmail;
use App\Models\ContactPhone;

class Contacts
{
    public static function storeEmail($emails, $contact)
    {
        $res = ContactEmail::where('contact_id', $contact)->get();
        if($res){
            foreach ($res as $re) {
                $re->delete();
            }
        }

        //save emails
        if($emails){
            foreach ($emails as $email) {
                $data = [
                    'email' => $email,
                    'contact_id' => $contact
                ];
                ContactEmail::create($data);
            }
        }
    }
    public static function storephone($request, $contact)
    {
        $res = ContactPhone::where('contact_id', $contact)->get();
        if($res){
            foreach ($res as $re) {
                $re->delete();
            }
        }

        //save phone
        if($request->phone){
            $type = [];
            for ($i = 0; $i < count($request->phone); $i++) {
                $type['type']   =  $request->type[$i];
                $type['phone']  =  $request->phone[$i];
                $type['contact_id']  =  $contact;

                ContactPhone::create($type);
            }
        }
    }

    public static function storeCompany($request, $contact)
    {
        $res = ContactCompany::where('contact_id', $contact)->get();
        if($res){
            foreach ($res as $re) {
                $re->delete();
            }
        }

        //save company
        if($request->zipcode){
            $data = [
                'name'          =>$request->company_name,
                'contact_name'  =>$request->contact_name,
                'email'         =>$request->company_email,
                'site'          =>$request->company_site,
                'phone'         =>$request->company_phone,
                'cellphone'     =>$request->company_cellphone,
                'zipcode'       =>$request->zipcode,
                'address'       =>$request->address,
                'district'      =>$request->district,
                'number'        =>$request->number,
                'state'         =>$request->state,
                'city'          =>$request->city,
                'contact_id'    =>$contact,
            ];

            ContactCompany::create($data);
        }
    }
}