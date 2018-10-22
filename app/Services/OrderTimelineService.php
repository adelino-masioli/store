<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 10/4/2018
 * Time: 10:40
 */

namespace App\Services;


use App\Models\OrderAnnotation;
use App\Models\OrderTimeline;
use Illuminate\Support\Facades\Auth;

class OrderTimelineService
{
    //store
    public static function store($order, $request=null)
    {
        $description = $request != null ? $request['description'] : '';
        $data = [
            'user_name'        => Auth::user()->name,
            'customer_name'    => $order->name,
            'description'      => $description,
            'order_id'         => $order->id,
            'user_id'          => Auth::user()->id,
            'customer_id'      => $order->customer_id,
            'configuration_id' => $order->configuration_id,
            'status_id'        => $order->status_id
        ];
        OrderTimeline::create($data);
    }

    //update
    public static function update($timeline, $request)
    {
        $res = OrderTimeline::findOrFail($timeline);
        $data = [
            'description' => $request['description'],
        ];
        $res->update($data);
    }

    //destroy
    public static function destroy($id)
    {
        $res = OrderTimeline::where('order_id', $id)->get();
        foreach ($res as $re) {
            $data['status_id'] = canceledRegister();
            $re->update($data);
        }

        $annotations =OrderAnnotation::where('order_id', $id)->get();
        foreach ($annotations as $annotation) {
            $data['status_id'] = canceledRegister();
            $annotation->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

}