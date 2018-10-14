<?php
namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Quote;
use App\Models\SubCategory;
use App\Services\ConfigurationSite;
use App\Services\Correios;
use App\Services\InputFields;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ShoppingcartController extends Controller
{

    public static function index()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::orderBy('id', 'desc')->where('configuration_id', $config_site->id)->where('status_id', 1)->take(8)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        $banners = Banner::where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.shoppingcart.home', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }

    public static function store($product=null,$product_id=null)
    {
        try{
            $id = base64_decode($product_id);
            $res = Product::findOrFail($id);
            $image = ProductImage::getCoverImage($res->id);

            //transport if isset
            $transport = self::transport($res);

            Cart::add([
                'id'=>$res->id,
                'name'=>$res->name,
                'qty' =>1,
                'price' =>$res->price,
                'options' => [
                    'image' => $image,
                    'transp_days' => $transport['transp_days'],
                    'transp_price' => $transport['transp_price'],
                    'transp_city' => $transport['transp_city'],
                    'transp_state' => $transport['transp_state']
                ]
            ]);

            session()->flash('success_message', 'Produto adicionado com sucesso!');
            return redirect()->route('frontend-shoppingcart-home');
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao adicionar o produto '.$res->name.'!');
            return redirect()->back();
        }
    }

    public static function remove($product=null,$row=null)
    {

        try{
            $rowId = base64_decode($row);
            Cart::remove($rowId);

            if( Cart::count()==0){
                session()->forget('zipcode');
            }

            session()->flash('success_message', 'Produto removido com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao removido o produto!');
            return redirect()->back();
        }
    }

    public static function update(Request $request, $product=null)
    {

        try{
            $rowId = base64_decode($request->rowid);
            Cart::update($rowId, ['qty' => $request->qty]);

            session()->flash('success_message', 'Produto atualizado com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao atualizado o produto!');
            return redirect()->back();
        }
    }

    public static function finish($shopcart=null)
    {
        try{
            if(!Auth::user()) {
                return redirect()->route('frontend-login');
                exit();
            }
            $total = Cart::total() - Cart::tax();
            $order =  Order::create(InputFields::inputFieldsOrderStore(Auth::user(), $total));
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

            session()->flash('success_message', 'Pedido finalizado com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao finalizar o pedido!');
            return redirect()->back();
        }
    }

    //transport
    public static function transport($product){
        $array_transport = [];
        if(session()->has('transport')){
            $array_transport['transp_days']  = session()->get('transport')['prazo'];
            $array_transport['transp_price'] = session()->get('transport')['valor'];
            $array_transport['transp_city'] = session()->get('transport')['localidade'];
            $array_transport['transp_state'] = session()->get('transport')['uf'];

            if(!session()->has('zipcode')){
                session()->put('zipcode', session()->get('transport')['cep']);
            }

            //clear session transport
            session()->forget('transport');

            return $array_transport;
        }else{
            if(session()->has('zipcode')){
                Correios::recalculaFrete($product, session()->get('zipcode'));

                $array_transport['transp_days']  = session()->get('transport')['prazo'];
                $array_transport['transp_price'] = session()->get('transport')['valor'];
                $array_transport['transp_city'] = session()->get('transport')['localidade'];
                $array_transport['transp_state'] = session()->get('transport')['uf'];
                //clear session transport
                session()->forget('transport');

                return $array_transport;
            }else {
                $array_transport['transp_days'] = null;
                $array_transport['transp_price'] = null;
                $array_transport['transp_city'] = null;
                $array_transport['transp_state'] = null;

                return $array_transport;
            }
        }
    }
}