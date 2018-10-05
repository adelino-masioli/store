<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAnnotation;
use App\Models\OrderItem;
use App\Models\OrderTimeline;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\OrderTimelineService;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.order.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Order;
        $columns = ['id',  'name', 'email', 'origin',  'total', 'created_at',  'user_id',  'status_id'];
        $result  = $this->dataTableOrder($model, $columns, true, 1);

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
                if($data->status_id > statusOrder('proccess')){
                    return '<a onclick="localStorage.clear();" href="'.route('order-show', [base64_encode($data->id)]).'"  title="Visualizar" class="btn bg-green btn-xs"><i class="fa fa-eye"></i> Visualizar</a>';
                }else{
                    return '<a onclick="localStorage.clear();" href="'.route('order-edit', [base64_encode($data->id)]).'"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="'.route('order-destroy', [base64_encode($data->id)]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
                }

            })
            ->orderColumn('name', 'id $1')
            ->setRowClass(function ($data) {
                return bgColor($data->status_id);
            })
            ->toJson();
    }

    //quote
    public function indexQuote()
    {
        return view('admin.order.home-quote');
    }
    //datatable quote
    public function getDatatableQuope(Request $request)
    {
        $model = new \App\Models\Order;
        $columns = ['id',  'name', 'email', 'total', 'created_at',  'status_id'];
        $result  = $this->dataTableOrder($model, $columns, true, 2);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('created_at', function ($data) {
                return date_br($data->created_at);
            })
            ->addColumn('total', function ($data) {
                return money_br($data->total);
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="'.route('quote-show', [base64_encode($data->id)]).'"  title="Visualizar" class="btn bg-green btn-xs"><i class="fa fa-eye"></i> Visualizar</a>';
            })
            ->setRowClass(function ($data) {
                return bgColor($data->status_id);
            })
            ->toJson();
    }


    //create
    public function create()
    {
        $status = Status::where('flag', 'order')->get();
        return view('admin.order.create', compact('status'));
    }

    //store
    public static function store(Request $request)
    {
        try{
            $messages = Messages::msgOrder();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:3|max:100',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $res = Order::create(InputFields::inputFieldsOrder($request));

            OrderTimelineService::store($res, $request);

            return redirect(route('order-edit', [base64_encode($res->id)]));
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //edit
    public static function edit($id_order)
    {
        $id = base64_decode($id_order);

        $order = Order::findOrfail($id);
        if($order->status_id > 7){
            session()->flash('error', 'Este pedido já não pode mais ser editado!');
            return redirect(route('orders'));
        }

        $status = Status::where('flag', 'order')->get();
        $items = OrderItem::where('order_id', $id)->get();
        return view('admin.order.edit', compact('order','status', 'items'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $res= Order::findOrFail($request->id);

            $messages = Messages::msgOrder();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5|max:100',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $res->update(InputFields::inputFieldsOrder($request));

            if($request['type'] == 2){
                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                session()->flash('success', 'Salvo com sucesso!');
                return redirect(route('order-edit', [base64_encode($res->id)]));
            }
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //show
    public static function show($id_order)
    {
        $id = base64_decode($id_order);
        $order = Order::findOrfail($id);
        $status = Status::where('flag', 'order')->get();
        $items = OrderItem::where('order_id', $id)->get();
        $annotations = OrderAnnotation::where('order_id', $id)->get();
        return view('admin.order.show', compact('order', 'status', 'items', 'annotations'));
    }
    //quote show
    public static function quoteShow($id_order)
    {
        $id = base64_decode($id_order);
        $quote = Order::findOrfail($id);
        $status = Status::where('flag', 'order')->get();
        $items = OrderItem::where('order_id', $id)->get();
        return view('admin.order.quote-show', compact('quote', 'status', 'items'));
    }


    //update status
    public static function updateStatus(Request $request)
    {
        try{
            $res= Order::findOrFail($request->id);

            $data = [
                'status_id'   => $request['status_id']
            ];
            $res->update($data);

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    public static function discount(Request $request)
    {
        if($request->discount != ''){
            $res = Order::findOrFail($request->order_id);
            $discount['discount'] = moneyReverse($request->discount);
            $res->update($discount);
            return json_encode(true);
        }else {
            return json_encode(false);
        }
    }

    //destroy
    public static function destroy($id_order)
    {
        $id = base64_decode($id_order);

        $res = Order::findOrfail($id);
        if($res){
            $data['status_id'] = statusOrder('canceled');
            $res->update($data);
        }
        OrderTimelineService::destroy($id);
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }


    //next confirm
    public static function nextConfirm($id_order)
    {
        $id = base64_decode($id_order);

        $count = OrderItem::where('order_id', $id)->count();
        if($count > 0){
            return redirect(route('order-confirm', [$id_order]));
        }else{
            session()->flash('error', 'Favor adicionar itens ao pedido!');
            return redirect()->back();
        }
    }


    //payment
    public static function orderConfirm($id_order)
    {
        $id = base64_decode($id_order);

        $order = Order::findOrfail($id);
        if($order->status_id > 7){
            session()->flash('error', 'Este pedido já não pode mais ser editado!');
            return redirect(route('orders'));
        }

        $status = Status::where('flag', 'reader')->get();
        $items = OrderItem::where('order_id', $id_order)->get();
        $payment = true;
        return view('admin.order.edit', compact('order', 'status',  'items',  'payment'));
    }

    //next finish
    public static function nextFinish($id_order)
    {
        $id = base64_decode($id_order);

        $count = OrderItem::where('order_id', $id)->count();
        if($count > 0){
            $res = Order::findOrfail($id);
            if($res){
                $data['status_id'] = statusOrder('financial');
                $res->update($data);
            }
            //add timeline
            OrderTimelineService::store($res, null);

            session()->flash('success', 'Pedido finalizado com sucesso. Já está no financeiro.');
            return redirect(route('orders'));
        }else{
            session()->flash('error', 'Favor adicionar itens ao pedido!');
            return redirect()->back();
        }
    }


    //quote cancel
    public static function quoteCancel($id_order)
    {
        $id = base64_decode($id_order);

        $res = Order::findOrfail($id);
        if($res){
            $data['status_id'] = 13;
            $res->update($data);
        }
        session()->flash('success', 'Cancelado com sucesso!');
        return redirect(route('quotes'));
    }

    //quote convert
    public static function quoteConvert($id_order)
    {
        $id = base64_decode($id_order);

        $res = Order::findOrfail($id);
        if($res){
            $data['type'] = 1;
            $data['user_id'] = Auth::user()->id;
            $data['status_id'] = 7;
            $res->update($data);
        }
        session()->flash('success', 'Salvo com sucesso!');
        return redirect(route('order-edit', [base64_encode($res->id)]));
    }


    //print
    public static function print($id_order)
    {
        $id = base64_decode($id_order);
        $order = Order::findOrfail($id);
        $status = Status::where('flag', 'order')->get();
        $items = OrderItem::where('order_id', $id)->get();
        return view('admin.order.print', compact('order', 'status', 'items'));
    }
}
