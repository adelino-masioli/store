<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteIten;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class QuoteItemController extends Controller
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
            $item = QuoteIten::where('product_id', $request->product_id)->where('quote_id', $request->quote_id);

            $qty = $request->product_qty > 0 ? $request->product_qty : 1;

            $array = [
                'product_name' => $request->product_name,
                'qty' => $qty,
                'price' => $request->product_price,
                'subtotal' => $qty * $request->product_price,
                'quote_id' => $request->quote_id,
                'product_id' => $request->product_id
            ];

            if($item->count() == 0) {
                QuoteIten::create($array);
            }else{
                $qty_up            = $item->first()->qty + $qty;
                $array['qty']      = $qty_up;
                $array['subtotal'] = $qty_up * $request->product_price;
                $item->first()->update($array);
            }

            //update quote total
            $quote = Quote::findOrFail($request->quote_id);
            $itemtotal = QuoteIten::where('quote_id', $quote->id)->sum('subtotal');
            $totalquote['total'] = $itemtotal;
            $quote->update($totalquote);

             return json_encode(true);
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //get
    public function get($id)
    {
        $quote = Quote::findOrfail($id);
        $quteitens = QuoteIten::where('quote_id', $id)->get();
        return view('admin.quote.partials.tableitens', compact('quteitens', 'quote'));
    }


    //destroy
    public static function destroy(Request $request)
    {
        $quote_id = $request->quote_id;
        $count = QuoteIten::where('quote_id', $quote_id)->count();
        $quote = Quote::findOrFail($quote_id);

        $item_id  = $request->item;
        $quoteitem = QuoteIten::findOrfail($item_id);


        if($count > 1){
            $totalquote['total'] = $quote->total - $quoteitem->subtotal;
            $quote->update($totalquote);
        }else{
            $totalquote['total'] = 0;
            $totalquote['discount'] = 0;
            $quote->update($totalquote);
        }

        if($quoteitem){
            $quoteitem->delete();
        }

        $msg = ['status' => 1, 'count' => $count];
        return response()->json($msg);
    }

}
