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
use App\Services\CreateAddress;
use App\Services\InputFields;
use App\Services\Messages;
use App\User;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    //login
    public static function login()
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
        return view('frontend.'.$config_site->theme.'.pages.customer.login', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }

    //post login
    public static function postLogin(Request $request)
    {
        try{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                session()->flash('success_message', 'Usuário logado com sucesso!');
                return redirect()->route('frontend-shoppingcart-home');
            }else{
                session()->flash('error_message', 'Usuário e ou senhas não conferem!');
                return redirect()->back()->withInput();
            }
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao tentar fazer o login');
            return redirect()->back();
        }
    }

    //register
    public static function register()
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
        return view('frontend.'.$config_site->theme.'.pages.customer.registration', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }


    //post register
    public static function postRegister(Request $request)
    {
        try{
            $messages = Messages::msgUser();
            $validator = Validator::make($request->all(), [
                'name'       => 'required|string|min:5|max:50',
                'email'      => 'required|string|email|min:10|max:100|confirmed|unique:users',
                'password'   => 'required|min:6|confirmed', //password_confirmation
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $user = User::create(InputFields::inputFieldsUserSite($request));

            //create complement
            CreateAddress::createComplement($request, $user);

            session()->flash('success_message', 'Salvo com sucesso! favor acessar seu e-mail para confirmar.');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao salvar!');
            return redirect()->back()->withInput();
        }
    }

}