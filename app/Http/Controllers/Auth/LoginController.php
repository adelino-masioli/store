<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
    {
        if(Auth::user()->status_id == statusOrder('inactive')){
            Auth::logout();

            session()->flash('error', 'Favor entrar em contato com o suporte.');
            return redirect('/login');
            exit();
        }

        if(Auth::user()->type_id == 5){
            return redirect('/admin/orders-financial');
        }else if(Auth::user()->type_id == 6){
            return redirect('/admin/orders-production');
        }else if(Auth::user()->type_id == 7){
            return redirect('/admin/orders-expedition');
        }else if(Auth::user()->type_id == 8){
            return redirect('/customer/dashboard');
        }else{
            return redirect('/admin/dashboard');
        }
        return redirect()->intended($this->redirectPath());
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
