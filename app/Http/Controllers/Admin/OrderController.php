<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
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
        $columns = ['id',  'name', 'email', 'phone', 'about', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('action', function ($data) {
                if($data->status_id == 3){
                    return '<a onclick="localStorage.clear();" href="'.route('order-edit', [$data->id]).'"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-dollar"></i></a>
                        <a href="'.route('order-destroy', [$data->id]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
                }else{
                    return '<a onclick="localStorage.clear();" href="'.route('order-show', [$data->id]).'"  title="Visualizar" class="btn bg-green btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0);"  title="Excluir" class="btn bg-red btn-xs disabled"><i class="fa fa-trash"></i></a>
                        ';
                }

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
                'name'             => 'required|string|min:5|max:100',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $res = Order::create(InputFields::inputFieldsOrder($request));

            return redirect(route('order-edit', [$res->id]));
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //edit
    public static function edit($id)
    {
        $order = Order::findOrfail($id);
        $status = Status::where('flag', 'reader')->get();
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

            session()->flash('success', 'Salvo com sucesso!');
            return redirect(route('order-edit', [$res->id]));
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //show
    public static function show($id)
    {
        $order = Order::findOrfail($id);
        $status = Status::where('flag', 'reader')->get();
        $items = OrderItem::where('quote_id', $id)->get();
        return view('admin.order.show', compact('order', 'status', 'items'));
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
    public static function destroy($id)
    {
        $res = Order::findOrfail($id);
        if($res){
            $data['status_id'] = 10;
            $res->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }


    //next payment
    public static function nextPayment($id)
    {
        $count = OrderItem::where('order_id', $id)->count();
        if($count > 0){
            return redirect(route('order-payment', [$id]));
        }else{
            session()->flash('error', 'Favor adicionar itens ao orçamento!');
            return redirect()->back();
        }
    }
}
