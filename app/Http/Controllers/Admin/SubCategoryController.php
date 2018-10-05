<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Configuration;
use App\Models\Status;
use App\Models\SubCategory;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.subcategory.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\SubCategory;
        $columns = ['id',  'name', 'deep', 'category_id', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('category', function ($data) {
                return $data->category_id ?  $data->category->name : '--';
            })
            ->addColumn('action', function ($data) {
                if($data->status_id == canceledRegister()) {
                    return '<a onclick="localStorage.clear();" href="' . route('subcategory-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                         <a href="javascript:void(0);"  title="Excluir" class="btn bg-red btn-xs disabled"><i class="fa fa-trash"></i></a>
                        ';
                }else{
                    return '<a onclick="localStorage.clear();" href="' . route('subcategory-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="' . route('subcategory-destroy', [base64_encode($data->id)]) . '"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
                }
            })
            ->toJson();
    }

    //create
    public function create()
    {
        $status = Status::where('flag', 'default')->get();
        $categories = Category::where('configuration_id', Auth::user()->configuration_id)->get();
        if(Auth::user()->type_id > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        return view('admin.subcategory.create', compact('status','configurations', 'categories'));
    }


    //store
    public static function store(Request $request)
    {
        try{
            $messages = Messages::msgSubCategory();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5|max:50|unique:sub_categories',
                'description'      => 'required',
                'category_id'      => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            SubCategory::create(InputFields::inputFieldsSubCategory($request));

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //edit
    public static function edit($subcategory_id)
    {
        $id = base64_decode($subcategory_id);
        $subcategory = SubCategory::findOrfail($id);
        $categories = Category::where('configuration_id', Auth::user()->configuration_id)->get();
        $status = Status::where('flag', 'default')->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }

        return view('admin.subcategory.edit', compact('subcategory', 'status','configurations', 'categories'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $result = SubCategory::findOrFail($request->id);

            $messages = Messages::msgSubCategory();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5max:200|unique:sub_categories,name,'.$request['id'],
                'description'      => 'required',
                'category_id'      => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $data = InputFields::inputFieldsSubCategory($request);
            $result->update($data);

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //destroy
    public static function destroy($subcategory_id)
    {
        $id = base64_decode($subcategory_id);
        $result = SubCategory::findOrfail($id);
        if($result){
            $data['status_id'] = canceledRegister();
            $result->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
