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
use App\Models\ProductRate;
use App\Models\Quote;
use App\Models\SubCategory;
use App\Services\ConfigurationSite;
use App\Services\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SiteController extends Controller
{
    public static function index()
    {
        //return redirect('/login');

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
        return view('frontend.'.$config_site->theme.'.pages.home', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }
    public static function about()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        $page_display = Page::where('configuration_id', $config_site->id)->where('type', 'about')->where('status_id', 1)->first();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.about', compact('categories', 'config_site', 'page', 'page_display', 'menu'));
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
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.contact', compact('categories', 'config_site', 'page', 'menu'));
    }
    public static function category(Request $request, $slug)
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $category = Category::where('slug', $slug)->where('status_id', 1)->first();
        $subcategory = SubCategory::where('slug', $slug)->where('status_id', 1)->first();

        if($category) {
            $products = Product::where('configuration_id', $config_site->id)
                ->where('status_id', 1)
                ->join('product_categories', 'products.id', 'product_categories.product_id')
                ->where('category_id', $category->id)
                ->where('status_id', 1);
        }else{
            $products = Product::where('configuration_id', $config_site->id)
                ->where('status_id', 1)
                ->join('product_categories', 'products.id', 'product_categories.product_id')
                ->where('subcategory_id', $subcategory->id)
                ->where('status_id', 1);
        }


        if($request['filtrar']) {
            if($request['filtrar'] == 'Menor preço'){
                $products->orderBy('price', 'asc');
            }
            if($request['filtrar'] == 'Ordem alfabética'){
                $products->orderBy('products.id', 'asc');
            }
            if($request['filtrar'] == 'Mais novos'){
                $products->orderBy('products.id', 'desc');
            }
        }
        $products = $products->paginate(12);


        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        $page_display = Page::where('configuration_id', $config_site->id)->where('type', 'product')->where('status_id', 1)->first();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.products', compact('categories', 'products', 'config_site', 'page', 'page_display', 'menu', 'category', 'subcategory'));
    }

    public static function product(Request $request)
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::where('configuration_id', $config_site->id)->where('status_id', 1);

        if($request['filtrar']) {
            if($request['filtrar'] == 'Menor preço'){
                $products->orderBy('price', 'asc');
            }
            if($request['filtrar'] == 'Ordem alfabética'){
                $products->orderBy('products.id', 'asc');
            }
            if($request['filtrar'] == 'Mais novos'){
                $products->orderBy('products.id', 'desc');
            }
        }
        $products = $products->paginate(12);


        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        $page_display = Page::where('configuration_id', $config_site->id)->where('type', 'product')->where('status_id', 1)->first();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.products', compact('categories', 'products', 'config_site', 'page', 'page_display', 'menu'));
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

        $rate = Rate::rate($product->rate);
        $is_rate = Auth::user() ? ProductRate::where('product_id', $product->id)->where('user_id', Auth::user()->id)->count() : 0;

        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        $page_display = Page::where('configuration_id', $config_site->id)->where('type', 'product')->where('status_id', 1)->first();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.product', compact('categories', 'product', 'config_site', 'page', 'page_display', 'menu', 'rate', 'is_rate'));
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

        $products_res = Product::where('configuration_id', $config_site->id)->where('status_id', 1);

        if($request['q']) {
            $products = $products_res->where('name', 'like', '%' . $request['q'] . '%');
        }

        if($request['categoria']) {
            $category = Category::where('slug', $request['categoria'])->first();
            $products = $products_res->join('product_categories', 'products.id', 'product_categories.product_id')->where('category_id',  $category->id)->where('status_id', 1);
        }
        if($request['filtrar']) {
            if($request['filtrar'] == 'Menor preço'){
                $products->orderBy('price', 'asc');
            }
            if($request['filtrar'] == 'Ordem alfabética'){
                $products->orderBy('products.id', 'asc');
            }
            if($request['filtrar'] == 'Mais novos'){
                $products->orderBy('products.id', 'desc');
            }
        }
        $products = $products->paginate(12);


        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        $page_display = Page::where('configuration_id', $config_site->id)->where('type', 'product')->where('status_id', 1)->first();
        $search = $request['search'];
        return view('frontend.'.$config_site->theme.'.pages.products_search', compact('categories', 'products', 'search', 'page', 'page_display', 'menu'));
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

    public static function rate($product, $rate)
    {
        if(!Auth::user()){
            return redirect()->back();
        }else{
            $product_id = base64_decode($product);
            $product_rate = base64_decode($rate);

            $res = ProductRate::where('product_id', $product_id)->where('user_id', Auth::user()->id)->count();
            if($res == 0){
             ProductRate::create([
                 'rate'       => rate($product_rate),
                 'product_id' => $product_id,
                 'user_id'    => Auth::user()->id,
             ]);
            }
            return redirect()->back();
        }
    }
}