<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $products = Product::where('configuration_id', Auth::user()->configuration_id)->get();
        $orders = Order::where('configuration_id', Auth::user()->configuration_id)->get();
        $contacts = Contact::where('configuration_id', Auth::user()->configuration_id)->get();
        $documents = Document::where('configuration_id', Auth::user()->configuration_id)->get();
        return view('admin.dashboard.home', compact('products', 'orders', 'contacts', 'documents'));
    }
}
