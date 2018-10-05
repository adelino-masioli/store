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
use App\Models\Quote;
use App\Services\ConfigurationSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SiteController extends Controller
{
    public static function index()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::orderBy('id', 'desc')->where('configuration_id', $config_site->id)->where('status_id', 1)->take(20)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        $banners = Banner::where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        return view('frontend.'.$config_site->theme.'.pages.home', compact('categories', 'products', 'banners', 'config_site', 'page'));
    }
    public static function about()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'about')->where('status_id', 1)->first();
        return view('frontend.'.$config_site->theme.'.pages.about', compact('categories', 'config_site', 'page'));
    }
    public static function service()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'service')->where('status_id', 1)->first();
        return view('frontend.'.$config_site->theme.'.pages.service', compact('categories', 'config_site', 'page'));
    }
    public static function contact()
    {
        $config_site = ConfigurationSite::getConfiguration();
        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        return view('frontend.'.$config_site->theme.'.pages.contact', compact('categories', 'config_site', 'page'));
    }
    public static function product()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::orderBy('id', 'desc')->where('configuration_id', $config_site->id)->where('status_id', 1)->take(20)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'product')->where('status_id', 1)->first();
        return view('frontend.'.$config_site->theme.'.pages.products', compact('categories', 'products', 'config_site', 'page'));
    }

    public static function show($product)
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $product = Product::where('slug', $product)->where('configuration_id', $config_site->id)->where('status_id', 1)->take(1)->first();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'product')->where('status_id', 1)->first();
        return view('frontend.'.$config_site->theme.'.pages.product-detail', compact('categories', 'product', 'config_site', 'page'));
    }

    //post
    public static function result(Request $request)
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::where('name', 'like', '%' . $request['search'] . '%')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'product')->where('status_id', 1)->first();
        $search = $request['search'];
        return view('frontend.'.$config_site->theme.'.pages.products-search', compact('categories', 'products', 'search', 'page'));
    }
    //save newsletter
    public static function postNewsletter(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|max:200',
                'email'         => 'required|string|email|max:200|unique:newsletters',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }

            $config_site = ConfigurationSite::getConfiguration();
            Newsletter::create([
                'name'             => $request['name'],
                'email'            => $request['email'],
                'configuration_id' => $config_site->id,
                'status_id'        => 1,
            ]);
            session()->flash('success_newsletter', 'Cadastro efetuado com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_newsletter', 'Erro ao cadastrar-se!');
            return redirect()->back();
        }
    }
    public static function postContact(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|max:200',
                'email'         => 'required|string|email|max:200',
                'phone'         => 'required|string|max:20',
                'about'         => 'required|string|max:200',
                'message'       => 'required|string'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $config_site = ConfigurationSite::getConfiguration();
            Contact::create([
                'name'             => $request['name'],
                'email'            => $request['email'],
                'phone'            => $request['phone'],
                'about'            => $request['about'],
                'message'          => $request['message'],
                'configuration_id' => $config_site->id,
                'status_id'        => 3
            ]);
            session()->flash('success_contact', 'Contato enviado com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_contact', 'Erro ao cadastrar-se!');
            return redirect()->back();
        }
    }

    //generate quote
    public static function postQuote(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'product_name'  => 'required|string|max:200',
                'name'          => 'required|string|max:200',
                'email'         => 'required|string|email|max:200',
                'phone'         => 'required',
                'about'         => 'required|string|max:200',
                'description'   => 'required|string'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            //create quote
            $config_site = ConfigurationSite::getConfiguration();
            $order = Order::create([
                'origin'           => quoteOrigin(2),
                'type'             => 2,
                'name'             => $request['name'],
                'email'            => $request['email'],
                'phone'            => $request['phone'],
                'about'            => $request['about'],
                'description'      => $request['description'],
                'zipcode'          => $request['zipcode'],
                'address'          => $request['address'],
                'district'         => $request['district'],
                'number'           => $request['number'],
                'state'            => $request['state'],
                'city'             => $request['city'],
                'status_id'        => 3,
                'configuration_id' => $config_site->id
            ]);

            //create quote item
            $product_id = base64_decode($request['product_id']);
            $product = Product::findOrFail($product_id);

            OrderItem::create([
                'product_name' => $request['product_name'],
                'qty'          => 1,
                'price'        => $product->price,
                'subtotal'     => $product->price,
                'order_id'     => $order->id,
                'product_id'   => $product_id,
            ]);

            $order->update(['total'=>$product->price]);

            session()->flash('success_quote', 'Enviado com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_quote', 'Erro ao cadastrar-se!');
            return redirect()->back();
        }
    }
}