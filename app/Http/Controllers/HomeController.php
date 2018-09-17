<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Newsletter;
use App\Models\Quote;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public static function index()
    {
        $categories = Category::orderBy('name', 'ask')->take(12)->get();
        $products = Product::orderBy('id', 'desc')->take(20)->get();
        return view('sprintem.index', compact('categories', 'products'));
    }

    public static function result(Request $request)
    {
        $categories = Category::orderBy('name', 'ask')->take(12)->get();
        $products = Product::where('name', 'like', '%' . $request['search'] . '%')->orderBy('id', 'desc')->get();
        $busca = $request['search'];
        return view('sprintem.result', compact('categories', 'products', 'busca'));
    }

    public static function about()
    {
        $categories = Category::orderBy('name', 'ask')->take(12)->get();
        return view('sprintem.about', compact('categories'));
    }

    public static function contact()
    {
        $categories = Category::orderBy('name', 'ask')->take(12)->get();
        return view('sprintem.contact', compact('categories'));
    }

    public static function postNewsletter(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|max:200',
                'email'         => 'required|string|email|max:200|unique:newsletters',
            ]);
            if ($validator->fails()) {
                session()->flash('error', 'Erro ao cadastrar-se!');
                return redirect()->back();
                exit();
            }

            Newsletter::create([
                'name'          => $request['name'],
                'email'         => $request['email']
            ]);

            session()->flash('success', 'Cadastro efetuado com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao cadastrar-se!');
            return redirect()->back();
        }
    }

    public static function postQuote(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'product_name'  => 'required|string|max:200',
                'name'          => 'required|string|max:200',
                'email'         => 'required|string|email|max:200',
                'about'         => 'required|string|max:200',
                'message'       => 'required|string'
            ]);
            if ($validator->fails()) {
                session()->flash('error_quote', 'Erro ao cadastrar-se!');
                return redirect()->back();
                exit();
            }

            Quote::create([
                'product_name'  => $request['product_name'],
                'name'          => $request['name'],
                'email'         => $request['email'],
                'about'         => $request['about'],
                'message'       => $request['message'],
            ]);

            session()->flash('success_quote', 'Cadastro efetuado com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_quote', 'Erro ao cadastrar-se!');
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
                session()->flash('error_contact', 'Erro ao cadastrar-se!');
                return redirect()->back();
                exit();
            }

            Contact::create([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'phone'         => $request['phone'],
                'about'         => $request['about'],
                'message'       => $request['message'],
            ]);

            session()->flash('success_contact', 'Cadastro efetuado com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_contact', 'Erro ao cadastrar-se!');
            return redirect()->back();
        }
    }


}
