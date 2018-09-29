<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderIten;
use App\Models\Product;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //search
    public function search(Request $request)
    {
        if($request->product_name){
            $product = Product::where('name', 'like', '%'.$request->product_name.'%')->first();
        }else {
            $product = Product::where('id', $request->product_id)->first();
        }
        if($product){
            return $product;
        }else{
            return json_encode(false);
        }
    }

    //store
    public static function store(Request $request)
    {
        try{
            $item = OrderItem::where('product_id', $request->product_id)->where('order_id', $request->order_id);

            $qty = $request->product_qty > 0 ? $request->product_qty : 1;

            $array = [
                'product_name' => $request->product_name,
                'qty' => $qty,
                'price' => $request->product_price,
                'subtotal' => $qty * $request->product_price,
                'order_id' => $request->order_id,
                'product_id' => $request->product_id
            ];

            if($item->count() == 0) {
                OrderItem::create($array);
            }else{
                $qty_up            = $item->first()->qty + $qty;
                $array['qty']      = $qty_up;
                $array['subtotal'] = $qty_up * $request->product_price;
                $item->first()->update($array);
            }

            //update order total
            $order = Order::findOrFail($request->order_id);
            $itemtotal = OrderItem::where('order_id', $order->id)->sum('subtotal');
            $totalquote['total'] = $itemtotal;
            $order->update($totalquote);

             return json_encode(true);
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //get
    public function get($id)
    {
        $order = Order::findOrfail($id);
        $items = OrderItem::where('order_id', $id)->get();
        return view('admin.order.partials.tableitens', compact('items', 'order'));
    }


    //destroy
    public static function destroy(Request $request)
    {
        $order_id = $request->order_id;
        $count = OrderItem::where('order_id', $order_id)->count();
        $order = Order::findOrFail($order_id);

        $item_id  = $request->item;
        $orderitem = OrderItem::findOrfail($item_id);


        if($count > 1){
            $totalquote['total'] = $order->total - $orderitem->subtotal;
            $order->update($totalquote);
        }else{
            $totalquote['total'] = 0;
            $totalquote['discount'] = 0;
            $order->update($totalquote);
        }

        if($orderitem){
            $orderitem->delete();
        }

        $msg = ['status' => 1, 'count' => $count];
        return response()->json($msg);
    }

}
