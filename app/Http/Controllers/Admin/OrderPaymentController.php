<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderPayment;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use App\Services\OrderTimelineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderPaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //payment
    public static function payment($order_id)
    {
        $id = base64_decode($order_id);

        $order = Order::findOrfail($id);
        $status = Status::where('flag', 'reader')->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        $items = OrderItem::where('order_id', $id)->get();
        $payments  = Payment::get();
        $payment = true;

        $order_pay = OrderPayment::where('order_id', $id)->sum('price');


        return view('admin.financial.payment', compact('order', 'status', 'configurations', 'items', 'payments', 'payment', 'order_pay'));
    }


    //store
    public static function store(Request $request)
    {
        try{
            $order_payment = OrderPayment::where('order_id', $request->order_id)->where('payment_id', $request->payment_id);
            $order_payment_all = OrderPayment::where('order_id', $request->order_id)->sum('price');
            $order = Order::findOrFail($request->order_id);

            if($order_payment->count()){
                $order_payment->first()->delete();
            }

            if(moneyReverse($request->price) > ($order->total - $order->discount)){
                $msg = ['status' => 2, 'response' => 'O valor informado é maior que o total.'];
                return response()->json($msg);
                exit();
            }

            if (($order_payment_all + moneyReverse($request->price)) > ($order->total - $order->discount)) {
                $msg = ['status' => 2, 'response' => 'A SOMA dos valores informados é maior que o TOTAL.'];
                return response()->json($msg);
                exit();
            }


            if($order_payment->count() > 0){
                $array = [
                    'order_id'   => $request->order_id,
                    'payment_id' => $request->payment_id,
                    'price'      => moneyReverse($request->price)
                ];
                $order_payment->first()->update($array);
            }else{
                $array = [
                    'order_id'   => $request->order_id,
                    'payment_id' => $request->payment_id,
                    'price'      => moneyReverse($request->price)
                ];
                OrderPayment::create($array);
            }

            $order_payment_price = OrderPayment::where('order_id', $request->order_id)->sum('price');

            $msg = ['status' => 1, 'response' => 'Salvo com sucesso.', 'order_pay' => 'R$ '.money_br($order_payment_price), 'order_pay_diff' => 'R$ '.money_br(($order->total - $order->discount) - $order_payment_price)];
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao salvar o pagamento.'];
            return response()->json($msg);
        }
    }

    public function paymentConfirm($order_id)
    {
        $id = base64_decode($order_id);

        $order_payment_all = OrderPayment::where('order_id', $id)->sum('price');
        $order = Order::findOrFail($id);

        if($order_payment_all < ($order->total - $order->discount)){
            session()->flash('error', 'Favor revisar os valores do pagamento!');
            return redirect()->back();
        }else{
            if($order){
                $data['status_id'] = 9;
                $order->update($data);
            }
            //add timeline
            OrderTimelineService::store($order, null);
            return redirect(route('orders-financial'));
        }
    }

}
