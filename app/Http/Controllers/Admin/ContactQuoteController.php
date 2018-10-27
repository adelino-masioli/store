<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Mail\UserQuote;
use App\Models\Contact;
use App\Models\ContactCompany;
use App\Models\ContactEmail;
use App\Models\ContactPhone;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Quote;
use App\Services\InputFields;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class ContactQuoteController extends Controller
{

    //get
    public function get($contact)
    {
        $quotes = Order::with('user')
            ->with('status')
            ->where('customer_id', $contact)
            ->orderBy('id', 'desc')
            ->get();
        return $quotes;
    }

    public static function index()
    {
        $total = null;
        $cart_item = [];
        $cart_items = [];
        foreach (Cart::content() as $cart){
            $cart_item['rowId'] = $cart->rowId;
            $cart_item['id'] = $cart->id;
            $cart_item['name'] = $cart->name;
            $cart_item['price'] = money_br($cart->price);
            $cart_item['qty'] = $cart->qty;
            $cart_item['subtotal'] = money_br($cart->subtotal);

            $cart_items[] = $cart_item;
            $total += $cart->subtotal;
        }
        if(session()->has('discount')){
            $cart_items[]['total'] = money_br($total - moneyReverse(session()->get('discount')));
        }else{
            $cart_items[]['total'] = money_br($total);
        }

        return $cart_items;
    }

    public static function store(Request $request)
    {
        try{
            $res = Product::findOrFail($request->id);
            if(!$res){
                $msg = ['status' => 2, 'response' => 'Nenhum produto encontrado!'];
                return response()->json($msg);
                exit();
            }

            Cart::add([
                'id'    =>$res->id,
                'name'  =>$res->name,
                'qty'   =>$request->product_qty ? $request->product_qty : 1,
                'price' =>$res->price
            ]);

            $msg = ['status' => 1, 'response' => 'Produto adicionado com sucesso!'];
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao adicionar produto!'];
            return response()->json($msg);
        }
    }


    public static function discount(Request $request)
    {
        try{
            if( Cart::count()==0){
                $msg = ['status' => 2, 'response' => 'Erro ao adicionar desconto!', 'discount'=>'0,00'];
                session()->forget('discount');
                return response()->json($msg);
                exit();
            }
            $discount = moneyReverse($request->discount);
            $subtotal = null;
            foreach (Cart::content() as $cart){
                $subtotal += $cart->subtotal;
            }
            $total = $subtotal -  $discount;

            $msg = ['status' => 1, 'response' => 'Desconto adicionado com sucesso!', 'discount'=>money_br($discount), 'total'=>money_br($total)];

            session()->put('discount', money_br($discount));
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao adicionar desconto!'];
            return response()->json($msg);
        }
    }

    public static function remove(Request $request)
    {

        try{
            $rowId = $request->id;
            Cart::remove($rowId);

            if( Cart::count()==0){
                session()->forget('discount');
                $msg = ['status' => 1, 'response' => 'Produto removido com sucesso!', 'discount'=>'0,00'];
            }else{
                $msg = ['status' => 1, 'response' => 'Produto removido com sucesso!'];
            }
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao remover produto!'];
            return response()->json($msg);
        }
    }

    public static function cancel(Request $request)
    {

        try{
            Cart::destroy();
            session()->forget('discount');

            $msg = ['status' => 1, 'response' => 'Orçamento cancelado com sucesso!'];
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao cancelar orçamento!'];
            return response()->json($msg);
        }
    }

    public static function finish(Request $request)
    {
        try{
            if(Cart::total() && Cart::total()==0.00) {
                $msg = ['status' => 2, 'response' => 'Favor adicionar produtos ao orçamento!'];
                return response()->json($msg);
                exit();
            }

            $customer = Contact::findOrFail($request->customer_id);
            $email = ContactEmail::where('contact_id', $customer->id)->first();
            $phone = ContactPhone::where('contact_id', $customer->id)->first();
            $company = ContactCompany::where('contact_id', $customer->id)->first();

            $total = Cart::total() - Cart::tax();
            $order =  Order::create(InputFields::inputFieldsQuote($request, $customer, $email,  $phone, $company,  $total));
            foreach(Cart::content() as $row):
                $qty = $row->qty > 0 ? $row->qty : 1;
                $array = [
                    'product_name' => $row->name,
                    'qty'          => $qty,
                    'price'        => $row->price,
                    'subtotal'     => $qty * $row->price,
                    'order_id'     => $order->id,
                    'product_id'   => $row->id
                ];
                OrderItem::create($array);
            endforeach;

            Cart::destroy();
            session()->forget('discount');

            $msg = ['status' => 1, 'response' => 'Orçamento finalizado com sucesso!'];
            return response()->json($msg);

        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao finalizar orçamento!'];
            return response()->json($msg);
        }
    }

    public static function status(Request $request)
    {
        try{
            $order = Order::findOrFail($request->order_id);

            $order->update(['status_id'=>statusOrder($request->status)]);

            $msg = ['status' => 1, 'response' => 'Orçamento atualizado com sucesso!'];
            return response()->json($msg);

        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao atualizar orçamento!'];
            return response()->json($msg);
        }
    }

    public static function pdf($order_id)
    {
        $id = base64_decode($order_id);

        $data = Order::where('id', $id)->where('configuration_id', Auth::user()->configuration_id)->first();
        if($data){
            $items = OrderItem::where('order_id', $id)->get();
            $pdf = \PDF::loadView('admin.contact.pdf', compact('data', 'items'));
            $filename = str_slug(date('d-m-Y H-i-s'), '-');
            return $pdf->download('orcamento'.$filename.'.pdf');

            //return view('admin.contact.pdf', compact('data', 'items'));
        }else{
            session()->flash('error', 'Erro ao processar o arquivo PDF. Favor verificar a existência do mesmo!');
            return redirect()->back();
            exit();
        }
    }

    public static function sendMail(Request $request)
    {
        $order = base64_decode($request->order_id);
        $data = Order::where('id', $order)->where('configuration_id', Auth::user()->configuration_id)->first();
        if($data){
            $items = OrderItem::where('order_id', $data->id)->get();

            Mail::to($data->email)->send(new UserQuote($data, $items));

            $msg = ['status' => 1, 'response' => 'E-mail enviado com sucesso!'];
            return response()->json($msg);
        }else{
            $msg = ['status' => 2, 'response' => 'Erro ao enviar e-mail!'];
            return response()->json($msg);
        }
    }

}