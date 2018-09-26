<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Services\Messages;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
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
        $model = Category::select(['id',  'name', 'status',])->where('status', '!=', 3);

        return DataTables::eloquent($model)
            ->addColumn('status', function ($data) {
                return $data->status== 1 ? 'Ativo' : 'Inativo';
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
        return view('admin.category.create');
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
            Category::create([
                'name'             => $request['name'],
                'slug'             => str_slug($request['name'], '-'),
                'description'      => $request['description'],
                'status'           => $request['status']
            ]);

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
        return view('admin.category.edit', compact('category'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $category = Category::findOrFail($request->id);

            $messages = Messages::msgProduct();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5max:200|unique:categories,name,'.$request['id'],
                'description'      => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $data = [
                'name'             => $request['name'],
                'slug'             => str_slug($request['name'], '-'),
                'description'      => $request['description'],
                'status'           => $request['status']
            ];
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
