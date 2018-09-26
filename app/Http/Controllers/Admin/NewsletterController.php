<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsletterController extends Controller
{
    use DataTableTrait;
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
        $model = new \App\Models\Newsletter;
        $columns = ['id',  'name', 'email', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->toJson();
    }
}
