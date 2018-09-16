<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public static function index()
    {
        $categories = Category::orderBy('name', 'ask')->take(12)->get();
        $products = Product::orderBy('id', 'desc')->take(20)->get();
        return view('sprintem.index', compact('categories', 'products'));
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
}
