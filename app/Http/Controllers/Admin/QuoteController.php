<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuoteController extends Controller
{
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
        $model = Quote::select(['id',  'name', 'email', 'phone', 'about', 'status'])->where('status', '!=', 3);

        return DataTables::eloquent($model)
            ->addColumn('status', function ($data) {
                return $data->status== 1 ? 'Aberto' : 'Concluído';
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="'.route('quote-edit', [$data->id]).'"     title="Visualizar" class="btn bg-aqua btn-xs"><i class="fa fa-dollar"></i></a>
                        <a href="'.route('quote-destroy', [$data->id]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->toJson();
    }

    //edit
    public static function edit($id)
    {
        $quote = Quote::findOrfail($id);
        return view('admin.quote.edit', compact('quote'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $quote= Quote::findOrFail($request->id);

            $data = [
                'status'           => $request['status']
            ];
            $quote->update($data);

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //destroy
    public static function destroy($id)
    {
        $quote = Quote::findOrfail($id);
        if($quote){
            $data['status'] = 3;
            $quote->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
