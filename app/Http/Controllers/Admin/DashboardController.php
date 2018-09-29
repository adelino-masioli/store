<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $products = Product::all();
        $orders = Order::get();
        $contacts = Contact::all();
        $documents = Document::all();
        return view('admin.dashboard.home', compact('products', 'orders', 'contacts', 'documents'));
    }
}
