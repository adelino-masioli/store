<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.newsletter.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = Newsletter::select(['id',  'name', 'email',]);

        return DataTables::eloquent($model)->toJson();
    }
}
