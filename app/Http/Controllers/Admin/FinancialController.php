<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAnnotation;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Payment;
use App\Models\Status;
use App\Traits\DataTableTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $result  =  $model->select($columns)->where('configuration_id', Auth::user()->configuration_id)->where('type', 1)->where('status_id', '>', statusOrder('proccess'))->where('status_id', '!=', statusOrder('canceled'));

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
        $payments = Payment::orderBy('payment')->get();
        return view('admin.financial.show', compact('order', 'status', 'items', 'annotations', 'payments'));
    }

    //report
    public function report()
    {
        $users = User::where('configuration_id', Auth::user()->configuration_id)->where('id', '>', 1)->where('type_id', '<', 8)->orderBy('name')->get();
        $status = Status::where('flag', 'order')->orderBy('id')->get();
        return view('admin.financial.report', compact('users', 'status'));
    }

    //filter
    public function filter(Request $request)
    {
        session()->forget('order_filters');

        $res_orders = Order::where('configuration_id', Auth::user()->configuration_id);
        if(trim($request['customer_name'])) {
            $orders_list = $res_orders->where('name', 'LIKE', '%' . trim($request['customer_name']) . '%');
        }
        if(trim($request['user_id'])) {
            $orders_list = $res_orders->where('user_id', trim($request['user_id']));
        }
        if(trim($request['status_id'])) {
            $orders_list = $res_orders->where('status_id', trim($request['status_id']));
        }
        if(trim($request['date_begin']) && trim($request['date_end'])) {
            $dateS = new Carbon($request['date_begin']);
            $dateE = new Carbon($request['date_end']);
            $orders_list = $res_orders->whereBetween('created_at', array($dateS, $dateE));
        }

        $orders = $orders_list->orderBy('id')->get();

        //add to session
        session()->put('order_filters', $orders);

        return view('admin.financial.filter', compact( 'orders'));
    }

    //print
    public function print()
    {
        $orders = session('order_filters');
        return view('admin.financial.report-print', compact( 'orders'));
    }
}
