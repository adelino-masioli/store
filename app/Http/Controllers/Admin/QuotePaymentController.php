<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Quote;
use App\Models\QuoteIten;
use App\Models\QuotePayment;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class QuotePaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //payment
    public static function payment($id)
    {
        $quote = Quote::findOrfail($id);
        $status = Status::where('flag', 'reader')->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        $quteitens = QuoteIten::where('quote_id', $id)->get();
        $payments  = Payment::get();
        $payment = true;

        $quote_pay = QuotePayment::where('quote_id', $id)->sum('price');

        return view('admin.quote.payment', compact('quote', 'status', 'configurations', 'quteitens', 'payments', 'payment', 'quote_pay'));
    }


    //store
    public static function store(Request $request)
    {
        try{
            $quote_payment = QuotePayment::where('quote_id', $request->quote_id)->where('payment_id', $request->payment_id);
            $quote_payment_all = QuotePayment::where('quote_id', $request->quote_id)->sum('price');
            $quote = Quote::findOrFail($request->quote_id);

            if($quote_payment->count()){
                $quote_payment->first()->delete();
            }

            if(moneyReverse($request->price) > ($quote->total - $quote->discount)){
                $msg = ['status' => 2, 'response' => 'O valor informado é maior que o total.'];
                return response()->json($msg);
                exit();
            }

            if (($quote_payment_all + moneyReverse($request->price)) > ($quote->total - $quote->discount)) {
                $msg = ['status' => 2, 'response' => 'A SOMA dos valores informados é maior que o TOTAL.'];
                return response()->json($msg);
                exit();
            }


            if($quote_payment->count() > 0){
                $array = [
                    'quote_id'   => $request->quote_id,
                    'payment_id' => $request->payment_id,
                    'price'      => moneyReverse($request->price)
                ];
                $quote_payment->first()->update($array);
            }else{
                $array = [
                    'quote_id'   => $request->quote_id,
                    'payment_id' => $request->payment_id,
                    'price'      => moneyReverse($request->price)
                ];
                QuotePayment::create($array);
            }

            $quote_payment_price = QuotePayment::where('quote_id', $request->quote_id)->sum('price');

            $msg = ['status' => 1, 'response' => 'Salvo com sucesso.', 'quote_pay' => 'R$ '.money_br($quote_payment_price), 'quote_pay_diff' => 'R$ '.money_br(($quote->total - $quote->discount) - $quote_payment_price)];
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao salvar o pagamento.'];
            return response()->json($msg);
        }
    }

    public function paymentConfirm($id)
    {
        $quote_payment_all = QuotePayment::where('quote_id', $id)->sum('price');
        $quote = Quote::findOrFail($id);

        if($quote_payment_all < ($quote->total - $quote->discount)){

            session()->flash('error', 'Favor revisar os valores do pagamento!');
            return redirect()->back();
        }else{
            return redirect(route('quotes'));
        }
    }

}
