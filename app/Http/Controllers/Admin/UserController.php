<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Status;
use App\Models\UserComplement;
use App\Models\UserType;
use App\Services\CreateAddress;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\UploadImage;
use App\Traits\DataTableTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.user.home');
    }

    //search
    public function search(Request $request)
    {
        if($request->name){
            $res = User::with('complement')->where('name', 'like', '%'.$request->name.'%')->where('id', '!=', adminId())->first();
        }else {
            $res = User::with('complement')->where('id', $request->id)->where('id', '!=', adminId())->first();
        }
        if($res){
            return $res;
        }else{
            return json_encode(false);
        }
    }


    //me
    public function me()
    {
        $id = Auth::user()->id;
        $user = User::findOrfail($id);

        return view('admin.user.me', compact('user'));
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\User;
        $columns = ['id',  'name', 'email', 'configuration_id', 'type_id',  'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('type', function ($data) {
                return $data->type->type;
            })
            ->addColumn('configuration', function ($data) {
                return $data->configuration_id ? $data->configuration->name : 'Super Usuário';
            })
            ->addColumn('action', function ($data) {
                if($data->status_id == canceledRegister()) {
                    return '<a onclick="localStorage.clear();" href="' . route('user-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                         <a href="javascript:void(0);"  title="Excluir" class="btn bg-red btn-xs disabled"><i class="fa fa-trash"></i></a>
                        ';
                }else{
                    return '<a onclick="localStorage.clear();" href="' . route('user-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="' . route('user-destroy', [base64_encode($data->id)]) . '"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
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
        $types = UserType::where('id', '>', 1)->get();

        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        return view('admin.user.create', compact('status', 'types', 'configurations'));
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
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            User::create(InputFields::inputFieldsUser($request));

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //edit
    public static function edit($user_id)
    {
        $id = base64_decode($user_id);
        $user = User::findOrfail($id);

        $status = Status::where('flag', 'default')->get();
        $types = UserType::where('id', '>', 1)->get();

        $user_complemento = UserComplement::where('user_id', $id)->first();

        return view('admin.user.edit', compact('user', 'status', 'types',  'user_complemento'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $result = User::findOrFail($request->id);

            $messages = Messages::msgUser();

            if($request['password']) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|min:5|max:50',
                    'email' => 'required|string|email|min:5|max:150|unique:users,email,' . $request['id'],
                    'password' => 'required|min:6|confirmed', //password_confirmation
                ], $messages);
            }else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|min:5|max:50',
                    'email' => 'required|string|email|min:5|max:150|unique:users,email,' . $request['id']
                ], $messages);
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $data = InputFields::inputFieldsUser($request);
            $result->update($data);


            //create complement
            CreateAddress::createComplement($request);


            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //update avatar
    public static function updateAvatar(Request $request)
    {
        try{
            if($request->hasFile('image')) {
                $result = User::findOrFail($request->user_id);
                if(File::exists(public_path().'/avatar/thumb/'.$result->avatar)){
                    File::delete(public_path().'/avatar/thumb/'.$result->avatar);
                }
                if(File::exists(public_path().'/avatar/'.$result->avatar)){
                    File::delete(public_path().'/avatar/'.$result->avatar);
                }

                //get image attr
                $image = $request->file('image');
                $file = $image;
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . random_int(100, 999) .'.' . $extension;
                $path = defineUploadPath('avatar', null);

                $data['avatar'] = $fileName;
                $result->update($data);

                //upload image
                UploadImage::uploadImage(200, 70,  $file, $fileName, $path);


                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                session()->flash('error', 'Favor selecionar o avatar!');
                return redirect()->back();
            }
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //destroy
    public static function destroy($user_id)
    {
        $id = base64_decode($user_id);
        $result = User::findOrfail($id);
        if($result){
            $data['status_id'] = canceledRegister();
            $result->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

    //destroy
    public static function destroyAvatar($avatar_id)
    {
        $id = base64_decode($avatar_id);
        $file = User::findOrfail($id);
        destroyFile('avatar', $file->avatar, 'thumb');


        if($file){
            $data['avatar'] = '';
            $file->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
