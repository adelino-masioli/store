<?php
namespace App\Http\Controllers;
use App\Mail\UserRegister;
use App\Mail\UserRegisterSite;
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
use App\Services\CreateAddress;
use App\Services\InputFields;
use App\Services\Messages;
use App\User;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


class DashboardController extends Controller
{
    //index
    public static function index()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $partial = 'customer_form';
        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::orderBy('id', 'desc')->where('configuration_id', $config_site->id)->where('status_id', 1)->take(8)->get();
        $page = Page::where('configuration_id', $config_site->id)->where('type', 'contact')->where('status_id', 1)->first();
        $banners = Banner::where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.dashboard.home', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu', 'partial'));
    }

    //support
    public static function support()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $partial = 'customer_support';
        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::orderBy('id', 'desc')->where('configuration_id', $config_site->id)->where('status_id', 1)->take(8)->get();
        $banners = Banner::where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.dashboard.home', compact('categories', 'products', 'banners', 'config_site',  'menu', 'partial'));
    }

    //order
    public static function order()
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $orders = Order::where('customer_id', Auth::user()->id)->get();
        $partial = 'customer_order';
        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::orderBy('id', 'desc')->where('configuration_id', $config_site->id)->where('status_id', 1)->take(8)->get();
        $banners = Banner::where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.dashboard.home', compact('categories', 'products', 'banners', 'config_site',  'menu', 'partial', 'orders'));
    }

    //order detail
    public static function orderDetail($order_id)
    {
        $config_site = ConfigurationSite::getConfiguration();
        if(!isset($config_site) || $config_site == null || $config_site->theme == ''){
            return redirect('/login');
            exit();
        }

        $order = base64_decode($order_id);
        $order_itens = OrderItem::findOrFail($order)->get();
        $partial = 'customer_order_detail';
        $categories = Category::orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $products = Product::orderBy('id', 'desc')->where('configuration_id', $config_site->id)->where('status_id', 1)->take(8)->get();
        $banners = Banner::where('configuration_id', $config_site->id)->where('status_id', 1)->get();
        $menu = Category::orderBy('order', 'asc')->orderBy('name', 'asc')->where('configuration_id', $config_site->id)->where('display_on_menu', 1)->where('status_id', 1)->take(4)->get();
        return view('frontend.'.$config_site->theme.'.pages.dashboard.home', compact('categories', 'products', 'banners', 'config_site',  'menu', 'partial', 'order_itens'));
    }

}