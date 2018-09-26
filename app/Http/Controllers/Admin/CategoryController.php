<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Configuration;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.category.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Category;
        $columns = ['id',  'name',  'configuration_id', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('configuration', function ($data) {
                return $data->configuration_id ? $data->configuration->name : 'Sem proprietário';
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="'.route('category-edit', [$data->id]).'"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="'.route('category-destroy', [$data->id]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
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
        return view('admin.category.create', compact('status','configurations'));
    }


    //store
    public static function store(Request $request)
    {
        try{
            $messages = Messages::msgCategory();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5|max:50|unique:categories',
                'description'      => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            Category::create(InputFields::inputFieldsCategory($request));

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //edit
    public static function edit($id)
    {
        $category = Category::findOrfail($id);
        $status = Status::where('flag', 'default')->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }

        return view('admin.category.edit', compact('category', 'status','configurations'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $category = Category::findOrFail($request->id);

            $messages = Messages::msgCategory();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5max:200|unique:categories,name,'.$request['id'],
                'description'      => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $data = InputFields::inputFieldsCategory($request);
            $category->update($data);

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
        $product = Category::findOrfail($id);
        if($product){
            $data['status'] = 3;
            $product->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
