<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Product;
use App\Models\Order;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $approvals = Document::select('documents.id', 'documents.status_id',  'documents.name as doc_name')->join('document_users', 'documents.id', 'document_users.document_id')
            ->join('users', 'document_users.user_id', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->where('documents.type_id', 1)
            ->where('documents.configuration_id', Auth::user()->configuration_id)->get();

        $severals = Document::select('documents.id', 'documents.status_id',  'documents.name as doc_name')->join('document_users', 'documents.id', 'document_users.document_id')
            ->join('users', 'document_users.user_id', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->where('documents.type_id', 2)
            ->where('documents.configuration_id', Auth::user()->configuration_id)->get();

        $financials = Document::select('documents.id', 'documents.status_id',  'documents.name as doc_name')->join('document_users', 'documents.id', 'document_users.document_id')
            ->join('users', 'document_users.user_id', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->where('documents.type_id', 3)
            ->where('documents.configuration_id', Auth::user()->configuration_id)->get();

        $supports = Support::where('configuration_id', Auth::user()->configuration_id)->where('user_id', Auth::user()->id)->get();
        return view('customer.dashboard.home', compact('approvals', 'severals', 'financials', 'supports'));
    }
}
