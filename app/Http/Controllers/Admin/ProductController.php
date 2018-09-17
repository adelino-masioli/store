<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = Product::select(['id',  'name', 'status',]);

        return DataTables::eloquent($model)
            ->addColumn('status', function ($data) {
                return $data->active==1 ? 'Ativo' : 'Inativo';
            })
            ->addColumn('action', function ($data) {
                return '<a href="'.route('product-edit', [$data->id]).'"  class="btn btn-primary btn-xs">Editar</a>
                        <a href="'.route('product-destroy', [$data->id]).'"  class="btn btn-danger btn-xs">Excluir</a>
                        ';
            })
            ->toJson();
    }

    //create
    public static function create(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'sku'              => 'required|string',
                'name'             => 'required|string|max:200|unique:products',
                'description'      => 'required|string',
                'meta_title'       => 'required|string',
                'meta_description' => 'required|string',
                'meta_keyword'     => 'required|string',
                'price'            => 'required|string',
                'qty'              => 'required|string'
            ]);
            if ($validator->fails()) {
                session()->flash('error_quote', 'Erro ao salvar!');
                return redirect()->back();
                exit();
            }
            Product::create([
                'sku'              => $request['sku'],
                'name'             => $request['product_name'],
                'slug'             => str_slug($request['product_name'], '-'),
                'description'      => $request['description'],
                'meta_title'       => $request['meta_title'],
                'meta_description' => $request['meta_description'],
                'meta_keyword'     => $request['meta_keyword'],
                'price'            => $request['price'],
                'qty'              => $request['qty'],
                'status'           => $request['status'],
            ]);
            session()->flash('success_quote', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error_quote', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //edit
    public static function edit($id)
    {
        $product = Product::findOrfail($id);
        $product_categories = ProductCategory::where('product_id', $id)->get()->pluck('category_id')->toArray();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.product.edit', compact('product', 'categories', 'product_categories'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $product = Product::findOrFail($request->id);

            $validator = Validator::make($request->all(), [
                'sku'              => 'required|string',
                'name'             => 'required|string|max:200|unique:products,name,'.$request['id'],
                'description'      => 'required|string',
                'meta_title'       => 'required|string',
                'meta_description' => 'required|string',
                'meta_keyword'     => 'required|string',
                'price'            => 'required|string',
                'qty'              => 'required|string'
            ]);
            if ($validator->fails()) {
                session()->flash('error', 'Erro ao salvar!');
                return redirect()->back();
                exit();
            }
            $data = [
                'sku'              => $request['sku'],
                'name'             => $request['name'],
                'slug'             => str_slug($request['product_name'], '-'),
                'description'      => $request['description'],
                'meta_title'       => $request['meta_title'],
                'meta_description' => $request['meta_description'],
                'meta_keyword'     => $request['meta_keyword'],
                'price'            => moneyReverse($request['price']),
                'qty'              => $request['qty'],
                'status'           => $request['status'],
            ];
            $product->update($data);

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
        $product = Product::findOrfail($id);
        if($product){
            $product->delete();
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

    //product category
    public static function productCategory(Request $request)
    {
        try{
            $product_category = ProductCategory::where('product_id', $request['product_id'])->where('category_id', $request['category_id']);
            if($product_category->count() == 0) {
                ProductCategory::create([
                    'product_id' => $request['product_id'],
                    'category_id' => $request['category_id'],
                ]);
            }else{
                $product_category->first()->delete();
            }
            return 1;
        }catch(\Exception $e){
            session()->flash('error_quote', 'Erro ao cadastrar-se!');
            return redirect()->back();
        }
    }
}
