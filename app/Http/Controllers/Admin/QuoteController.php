<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\QuoteIten;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.quote.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Quote;
        $columns = ['id',  'name', 'email', 'phone', 'about', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('action', function ($data) {
                if($data->status_id == 3){
                    return '<a onclick="localStorage.clear();" href="'.route('quote-edit', [$data->id]).'"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-dollar"></i></a>
                        <a href="'.route('quote-destroy', [$data->id]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
                }else{
                    return '<a onclick="localStorage.clear();" href="'.route('quote-show', [$data->id]).'"  title="Visualizar" class="btn bg-green btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0);"  title="Excluir" class="btn bg-red btn-xs disabled"><i class="fa fa-trash"></i></a>
                        ';
                }

            })
            ->toJson();
    }

    //create
    public function create()
    {
        $status = Status::where('flag', 'default')->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        return view('admin.quote.create', compact('status','configurations'));
    }


    //store
    public static function store(Request $request)
    {
        try{
            $messages = Messages::msgQuote();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5|max:100',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $quote = Quote::create(InputFields::inputFieldsQuote($request));

            return redirect(route('quote-edit', [$quote->id]));
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //edit
    public static function edit($id)
    {
        $quote = Quote::findOrfail($id);
        $status = Status::where('flag', 'reader')->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        $quteitens = QuoteIten::where('quote_id', $id)->get();
        return view('admin.quote.edit', compact('quote', 'status', 'configurations', 'quteitens'));
    }


    //show
    public static function show($id)
    {
        $quote = Quote::findOrfail($id);
        $status = Status::where('flag', 'reader')->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        $quteitens = QuoteIten::where('quote_id', $id)->get();
        return view('admin.quote.show', compact('quote', 'status', 'configurations', 'quteitens'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $quote= Quote::findOrFail($request->id);

            $messages = Messages::msgQuote();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5|max:100',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $quote->update(InputFields::inputFieldsQuote($request));

            return redirect(route('quote-edit', [$quote->id]));
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //update status
    public static function updateStatus(Request $request)
    {
        try{
            $quote= Quote::findOrFail($request->id);

            $data = [
                'status_id'   => $request['status_id']
            ];
            $quote->update($data);

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
            $quote = Quote::findOrFail($request->quote_id);
            $discount['discount'] = moneyReverse($request->discount);
            $quote->update($discount);
            return json_encode(true);
        }else {
            return json_encode(false);
        }
    }

    //destroy
    public static function destroy($id)
    {
        $quote = Quote::findOrfail($id);
        if($quote){
            $data['status_id'] = 10;
            $quote->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }


    //next payment
    public static function nextPayment($id)
    {
        $count = QuoteIten::where('quote_id', $id)->count();
        if($count > 0){
            return redirect(route('quote-payment', [$id]));
        }else{
            session()->flash('error', 'Favor adicionar itens ao orçamento!');
            return redirect()->back();
        }
    }
}
