<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAnnotation;
use App\Models\OrderItem;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FinancialController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.financial.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Order;
        $columns = ['id',  'name', 'email', 'origin',  'total', 'created_at',  'user_id',  'status_id'];
        $result  =  $model->select($columns)->where('configuration_id', Auth::user()->configuration_id)->where('type', 1)->where('status_id', '>', 7)->where('status_id', '!=', statusOrder('canceled'))->orderBy('id', 'desc');

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('user', function ($data) {
                return $data->user->name;
            })
            ->addColumn('created_at', function ($data) {
                return date_br($data->created_at);
            })
            ->addColumn('total', function ($data) {
                return money_br($data->total);
            })
            ->addColumn('action', function ($data) {
                if($data->status_id > statusOrder('financial')){
                    return '<a onclick="localStorage.clear();" href="'.route('order-financial-show', [base64_encode($data->id)]).'"  title="Visualizar" class="btn bg-blue btn-xs"><i class="fa fa-eye"></i> Visualizar</a>';
                }else{
                    return '<a onclick="localStorage.clear();" href="'.route('order-payment', [base64_encode($data->id)]).'"  title="Finalizar" class="btn bg-green btn-xs"><i class="fa fa-dollar"></i> Finalizar</a>';
                }
            })
            ->setRowClass(function ($data) {
                return bgColor($data->status_id);
            })
            ->toJson();
    }
    //show
    public static function show($id_order)
    {
        $id = base64_decode($id_order);
        $order = Order::findOrfail($id);
        $status = Status::where('flag', 'order')->get();
        $items = OrderItem::where('order_id', $id)->get();
        $annotations = OrderAnnotation::where('order_id', $id)->get();
        return view('admin.financial.show', compact('order', 'status', 'items', 'annotations'));
    }
}
