<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public static function index($category_slug)
    {
        $category =  Category::where('slug', $category_slug)->where('status', 1)->first();
        $categories = Category::orderBy('name', 'ask')->where('status', 1)->take(12)->get();
        $products = Product::productByCategory($category->id);
        return view(config('app.template').'.products', compact('category', 'categories', 'products'));
    }

    public static function show($product_slug)
    {
        $categories = Category::orderBy('name', 'ask')->where('status', 1)->take(12)->get();
        $product = Product::where('slug', $product_slug)->where('status', 1)->first();
        $category = Product::productCategory($product->id);
        return view(config('app.template').'.product', compact('categories', 'category',  'product'));
    }
}
