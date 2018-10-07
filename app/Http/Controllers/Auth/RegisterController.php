<?php

namespace App\Http\Controllers\Auth;

use App\Mail\UserRegister;
use App\Services\InputFields;
use App\Services\Messages;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = Messages::msgUser();
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


        return redirect('/login');
    }


    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active_token' => md5(date('Y-m-d H:i:s')),
            'type_id' =>userTypeId('admin'),
            'status_id' => statusOrder('inactive'),
        ]);

        self::sendEmail($user);
    }


    public static function sendEmail($user)
    {
        Mail::to($user->email)->send(new UserRegister($user));
    }


    //activate
    public static function activate($token)
    {
        $user = User::where('active_token', $token)->first();
        if($user) {
            $user->update([
                'status_id' => statusOrder('active')
            ]);
            session()->flash('success', 'Cadastro ativado com sucesso! Agora você já pode fazer o login.');
            return redirect(route('activate-page'));
        }else{
            session()->flash('error', 'Erro ao ativar o cadastro. Favor contactar o suporte caso for este o link recebido em seu email.');
            return redirect(route('activate-page'));
        }
    }

    public static function  activatePage()
    {
        return view('auth.activate');
    }
}
