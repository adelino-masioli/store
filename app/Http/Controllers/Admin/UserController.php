<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Services\Messages;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.user.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = User::select(['id',  'name', 'email', 'type', 'status',])->where('status', '!=', 3);

        return DataTables::eloquent($model)
            ->addColumn('status', function ($data) {
                return $data->status== 1 ? 'Ativo' : 'Inativo';
            })
            ->addColumn('type', function ($data) {
                return userType($data->type);
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
        return view('admin.user.create');
    }


    //store
    public static function store(Request $request)
    {
        try{
            $messages = Messages::msgUser();
            $validator = Validator::make($request->all(), [
                'name'       => 'required|string|min:5|max:50',
                'email'      => 'required|string|email|min:5|max:50|unique:users',
                'password'   => 'required|min:6|confirmed', //password_confirmation
                'type'       => 'required|min:6|confirmed'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            User::create([
                'name'       => $request['name'],
                'email'      => $request['email'],
                'password'   => $request['password'],
                'type'       => $request['type'],
                'status'     => $request['status']
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
        $category = User::findOrfail($id);
        return view('admin.user.edit', compact('category'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $result = User::findOrFail($request->id);

            $messages = Messages::msgUser();
            $validator = Validator::make($request->all(), [
                'name'       => 'required|string|min:5|max:50',
                'email'      => 'required|string|email|min:5|max:150|unique:users',
                'password'   => 'required|min:6|confirmed', //password_confirmation
                'type'       => 'required|min:6|confirmed'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $data = [
                'name'       => $request['name'],
                'email'      => $request['email'],
                'password'   => $request['password'],
                'type'       => $request['type'],
                'status'     => $request['status']
            ];
            $result->update($data);

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
        $result = User::findOrfail($id);
        if($result){
            $data['status'] = 3;
            $result->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
