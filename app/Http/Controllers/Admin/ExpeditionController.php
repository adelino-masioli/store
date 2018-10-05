<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\OrderTimelineService;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ExpeditionController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.expedition.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Order;
        $columns = ['id',  'name', 'email', 'origin',  'total', 'created_at',  'user_id',  'status_id'];
        $result  =  $model->select($columns)->where('configuration_id', Auth::user()->configuration_id)->where('type', 1)->where('status_id', '!=', statusOrder('canceled'))->where('status_id', '>', statusOrder('production'));

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
                return '<a onclick="localStorage.clear();" href="'.route('order-expedition-show', [base64_encode($data->id)]).'"  title="Visualizar" class="btn bg-blue btn-xs"><i class="fa fa-eye"></i> Visualizar</a>';
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

        if($order){
            if($order->sttus_id == statusOrder('finished')) {
                $data['status_id'] = statusOrder('expedition');
                $order->update($data);
            }
        }


        $status = Status::where('flag', 'order')->get();
        $items = OrderItem::where('order_id', $id)->get();
        return view('admin.expedition.show', compact('order', 'status', 'items'));
    }


    //conference
    public static function conference($id_order)
    {
        $id = base64_decode($id_order);
        $res = Order::findOrfail($id);
        if($res){
            $data['status_id'] = statusOrder('expedition');
            $res->update($data);
        }
        //add timeline
        OrderTimelineService::store($res, null);

        session()->flash('success', 'Conferido com sucesso!');
        return redirect()->back();
    }

    //confirm
    public static function confirm($id_order)
    {
        $id = base64_decode($id_order);
        $res = Order::findOrfail($id);
        if($res){
            $data['status_id'] = statusOrder('delivered');
            $res->update($data);
        }
        //add timeline
        OrderTimelineService::store($res, null);
        session()->flash('success', 'Entregue com sucesso!');
        return redirect()->back();
    }
}
