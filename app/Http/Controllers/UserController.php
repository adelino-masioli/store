<?php
namespace App\Http\Controllers;
use App\Mail\UserRegisterSite;
use App\Mail\UserRegisterSiteReset;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Quote;
use App\Services\ConfigurationSite;
use App\Services\CreateAddress;
use App\Services\InputFields;
use App\Services\Messages;
use App\User;
use Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


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
                if(Auth::user()->type_id != userTypeId('customer')){
                    Auth::logout();
                    session()->flush();
                    session()->regenerate();
                    session()->flash('error_message', 'Usuário e ou senhas não conferem! Favor entrar em contato com o administrador.');
                    return redirect()->back();
                }else{
                    return redirect()->route('frontend-my-account');
                }
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

            session()->flash('success_message', 'Cadastro atualizado com sucesso!');
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


    //email
    public static function email()
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
        return view('frontend.'.$config_site->theme.'.pages.customer.email', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }
    //email success
    public static function emailSuccess()
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
        return view('frontend.'.$config_site->theme.'.pages.customer.email-success', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }

    //post email
    public static function postEmail(Request $request)
    {
        try{
            $messages = Messages::msgUser();
            $validator = Validator::make($request->all(), [
                'email'      => 'required|string|email|min:10|max:100',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $user = User::where('email', $request->email);

            if($user->count() == 0){
                session()->flash('error_message', 'Favor conferir o email informado!');
                return redirect()->back()->withInput();
                exit();
            }

            //generate token
            $data_token = [
                'status_id'    => statusOrder('inactive'),
                'active'       => 0,
                'active_token' => md5(date('Y-m-d H:i:s').'manazer'),
            ];
            $user->first()->update($data_token);

            self::sendEmailResetPassword($user->first());

            session()->flash('verify_code', $user->first()->active_token);
            return redirect()->route('frontend-email-password-success');
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao salvar!');
            return redirect()->back()->withInput();
        }
    }

    //reset
    public static function reset($token)
    {
        $user = User::where('active_token', $token);
        if($user->count() == 0){
            session()->flash('error_message', 'O token informado já foi expirado.');
            return redirect()-route('frontend-login');
            exit();
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
        return view('frontend.'.$config_site->theme.'.pages.customer.reset', compact('categories', 'products', 'banners', 'config_site', 'page', 'menu'));
    }

    //update reset
    public static function postReset(Request $request)
    {
        try{
            $result = User::where('email', $request->email);
            if($result->count() == 0){
                session()->flash('error_message', 'E-mail não encontrado ou inválido.');
                return redirect()->back()->withInput();
                exit();
            }
            $messages = Messages::msgUser();
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|min:5|max:150',
                'password' => 'required|min:6|confirmed',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $fields = [
                'password' => bcrypt($request['password']),
                'active' => 1,
                'active_token' => null,
                'status_id' => statusOrder('active')
            ];
            $result->first()->update($fields);

            session()->flash('success_message', 'Senha alterada com sucesso!');
            return redirect()->route('frontend-login');
        }catch(\Exception $e){
            session()->flash('error_message', 'Erro ao alterar senha!');
            return redirect()->back()->withInput();
        }
    }





    public static function sendEmail($user)
    {
        Mail::to($user->email)->send(new UserRegisterSite($user));
    }

    public static function sendEmailResetPassword($user)
    {
        Mail::to($user->email)->send(new UserRegisterSiteReset($user));
    }


    public function logout()
    {
        Auth::logout();
        $this->guard()->logout();
        session()->flush();
        session()->regenerate();
        return redirect()->route('frontend-login');
    }
}