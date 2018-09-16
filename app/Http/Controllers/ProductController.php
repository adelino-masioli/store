<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public static function index($category_slug)
    {
        $category =  Category::where('slug', $category_slug)->first();
        $categories = Category::orderBy('name', 'ask')->take(12)->get();
        $products = Product::productByCategory($category->id);
        return view('sprintem.products', compact('category', 'categories', 'products'));
    }

    public static function show($product_slug)
    {
        $categories = Category::orderBy('name', 'ask')->take(12)->get();
        $product = Product::where('slug', $product_slug)->first();
        $category = Product::productCategory($product->id);
        return view('sprintem.product', compact('categories', 'category',  'product'));
    }
}
