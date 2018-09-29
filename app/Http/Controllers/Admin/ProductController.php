<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\Models\Category;
use App\Models\Configuration;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Status;
use App\Models\SubCategory;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use DataTableTrait;

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
        $model = new \App\Models\Product;
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
                if($data->status_id == canceledRegister()) {
                    return '<a onclick="localStorage.clear();" href="' . route('product-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                         <a href="javascript:void(0);"  title="Excluir" class="btn bg-red btn-xs disabled"><i class="fa fa-trash"></i></a>
                        ';
                }else{
                    return '<a onclick="localStorage.clear();" href="' . route('product-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="' . route('product-destroy', [base64_encode($data->id)]) . '"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
                }
            })
            ->setRowClass(function ($data) {
                return switchColor($data->status_id);
            })
            ->toJson();
    }

    //create
    public function create()
    {
        $status = Status::where('flag', 'default')->get();
        return view('admin.product.create', compact('status'));
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
            $product = Product::create(InputFields::inputFieldsProduct($request));
            return redirect(route('product-edit', [base64_encode($product->id)]));
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //edit
    public static function edit($product_id)
    {
        $id = base64_decode($product_id);
        $product = Product::findOrfail($id);
        $product_categories = ProductCategory::where('product_id', $id)->get()->pluck('category_id')->toArray();
        $product_subcategories = ProductCategory::where('product_id', $id)->get()->pluck('subcategory_id')->toArray();
        $categories = Category::orderBy('name', 'asc')->where('status_id', '!=', canceledRegister())->get();
        $subcategories = SubCategory::orderBy('name', 'asc')->where('status_id', '!=', canceledRegister())->get();
        $product_images = ProductImage::where('product_id', $id)->get();

        $status = Status::where('flag', 'default')->get();
        return view('admin.product.edit', compact('product', 'categories', 'subcategories', 'product_categories', 'product_subcategories', 'product_images', 'status'));
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
            $data = InputFields::inputFieldsProduct($request);
            $product->update($data);

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }




    //destroy
    public static function destroy($product_id)
    {
        $id = base64_decode($product_id);
        $product = Product::findOrfail($id);
        if($product){
            $data['status_id'] = canceledRegister();
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
            session()->flash('error_quote', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //product subcategory
    public static function producSubCategory(Request $request)
    {
        try{
            $product_subcategory = ProductCategory::where('product_id', $request['product_id'])->where('subcategory_id', $request['subcategory_id']);
            if($product_subcategory->count() == 0) {
                ProductCategory::create([
                    'product_id' => $request['product_id'],
                    'subcategory_id' => $request['subcategory_id'],
                ]);
            }else{
                $product_subcategory->first()->delete();
            }
            return 1;
        }catch(\Exception $e){
            session()->flash('error_quote', 'Erro ao salvar!');
            return redirect()->back();
        }
    }
}
