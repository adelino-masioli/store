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
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class UserController extends Controller
{
    use AuthenticatesUsers;

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
                return redirect()->route('frontend-my-account');
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

            self::sendEmail($user);

            session()->flash('verify_code', $user->active_token);
            return redirect()->route('frontend-register-success');
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao salvar!');
            return redirect()->back()->withInput();
        }
    }

    //update register
    public static function postUpdate(Request $request)
    {
        try{
            $result = User::findOrFail($request->id);

            $messages = Messages::msgUser();

            if($request['password']) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|min:5|max:50',
                    'email' => 'required|string|email|min:5|max:150|unique:users,email,' . $request['id'],
                    'password' => 'required|min:6|confirmed', //password_confirmation
                ], $messages);
            }else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|min:5|max:50',
                    'email' => 'required|string|email|min:5|max:150|unique:users,email,' . $request['id']
                ], $messages);
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $data = InputFields::inputFieldsUserSite($request);
            $result->update($data);

            //create complement
            CreateAddress::createComplement($request, $result);

            session()->flash('success_message', 'Cadastro atualziado com sucesso!');
            return redirect()->route('frontend-my-account');
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao salvar!');
            return redirect()->back()->withInput();
        }
    }

    //register success
    public static function registerSuccess()
    {
        if(!session()->get("verify_code")){
            return redirect()->route('frontend-home');
        }
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
        return view('frontend.'.$config_site->theme.'.pages.customer.registration-success', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }

    //activate
    public static function activate($token)
    {
        $user = User::where('active_token', $token)->first();
        if($user) {
            $user->update([
                'active'       => statusOrder('active'),
                'active_token' => null,
                'status_id'    => statusOrder('active')
            ]);
            session()->flash('success', 'success');
            return redirect(route('frontend-register-activate-success'));
        }else{
            session()->flash('error', 'error');
            return redirect(route('frontend-register-activate-success'));
        }
    }

    public static function activatePage()
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
        return view('frontend.'.$config_site->theme.'.pages.customer.activate-success', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }

    public static function sendEmail($user)
    {
        Mail::to($user->email)->send(new UserRegisterSite($user));
    }


    public function logout()
    {
        $this->guard()->logout();
        session()->flush();
        session()->regenerate();
        return redirect()->route('frontend-home');
    }
}