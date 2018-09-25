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

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.product.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = Product::select(['id',  'name', 'status',])->where('status', '!=', 3);

        return DataTables::eloquent($model)
            ->addColumn('status', function ($data) {
                return $data->status== 1 ? 'Ativo' : 'Inativo';
            })
            ->addColumn('action', function ($data) {
                return '<a href="'.route('product-edit', [$data->id]).'"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="'.route('product-destroy', [$data->id]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->toJson();
    }

    //create
    public function create()
    {
        return view('admin.product.create');
    }


    //store
    public static function store(Request $request)
    {
        try{
            $messages = Messages::msgProduct();
            $validator = Validator::make($request->all(), [
                'sku'              => 'required',
                'name'             => 'required|string|min:5|max:200|unique:products',
                'description'      => 'required',
                'meta_title'       => 'required',
                'meta_description' => 'required',
                'meta_keyword'     => 'required',
                'price'            => 'required',
                'qty'              => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            $product = Product::create([
                'sku'              => $request['sku'],
                'name'             => $request['product_name'],
                'slug'             => str_slug($request['product_name'], '-'),
                'description'      => $request['description'],
                'meta_title'       => $request['meta_title'],
                'meta_description' => $request['meta_description'],
                'meta_keyword'     => $request['meta_keyword'],
                'price'            => moneyReverse($request['price']),
                'qty'              => $request['qty'],
                'status'           => 2
            ]);
            return redirect(route('product-edit', [$product->id]));
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //edit
    public static function edit($id)
    {
        $product = Product::findOrfail($id);
        $product_categories = ProductCategory::where('product_id', $id)->get()->pluck('category_id')->toArray();
        $categories = Category::orderBy('name', 'asc')->get();
        $product_images = ProductImage::where('product_id', $id)->get();
        return view('admin.product.edit', compact('product', 'categories', 'product_categories', 'product_images'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $product = Product::findOrFail($request->id);

            $messages = Messages::msgProduct();
            $validator = Validator::make($request->all(), [
                'sku'              => 'required',
                'name'             => 'required|string|min:5max:200|unique:products,name,'.$request['id'],
                'description'      => 'required',
                'meta_title'       => 'required',
                'meta_description' => 'required',
                'meta_keyword'     => 'required',
                'price'            => 'required',
                'qty'              => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
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
            $data['status'] = 3;
            $product->update($data);
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
