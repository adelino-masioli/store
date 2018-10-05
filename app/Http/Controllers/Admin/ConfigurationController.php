<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class ConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.configuration.home');
    }

    //myConfig
    public function myConfig()
    {
        $my_config = Configuration::findOrFail(Auth::user()->configuration_id);
        return view('admin.configuration.myconfig', compact('my_config'));
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = Configuration::select(['id',  'name', 'contact', 'email', 'phone', 'status_id']);

        return DataTables::eloquent($model)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('action', function ($data) {
                if($data->status_id == canceledRegister()) {
                    return '<a onclick="localStorage.clear();" href="' . route('configuration-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                         <a href="javascript:void(0);"  title="Excluir" class="btn bg-red btn-xs disabled"><i class="fa fa-trash"></i></a>
                        ';
                }else{
                    return '<a onclick="localStorage.clear();" href="' . route('configuration-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="' . route('configuration-destroy', [base64_encode($data->id)]) . '"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
                }
            })
            ->setRowClass(function ($data) {
                return bgColor($data->status_id);
            })
            ->toJson();
    }

    //create
    public function create()
    {
        $status = Status::where('flag', 'default')->get();
        return view('admin.configuration.create', compact('status'));
    }


    //store
    public static function store(Request $request)
    {

        try{
            $messages = Messages::msgConfig();
            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|min:5|max:50|unique:configurations',
                'contact'       => 'required',
                'email'         => 'required|string|email|min:5|max:150|unique:configurations',
                'phone'         => 'required',
                'about'         => 'required',
                'zipcode'       => 'required',
                'address'       => 'required',
                'district'      => 'required',
                'number'        => 'required',
                'state'         => 'required',
                'city'          => 'required',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            Configuration::create(InputFields::inputFieldsConfiguration($request));

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //edit
    public static function edit($config_id)
    {
        $id = base64_decode($config_id);
        $configuration = Configuration::findOrfail($id);
        $status = Status::where('flag', 'default')->get();
        return view('admin.configuration.edit', compact('configuration','status'));
    }


    //update
    public static function update(Request $request)
    {

        try{
            $result = Configuration::findOrFail($request->id);

            $messages = Messages::msgConfig();
            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|min:5|max:50|unique:configurations,name,'.$request['id'],
                'contact'       => 'required',
                'email'         => 'required|string|email|min:5|max:150|unique:configurations,email,'.$request['id'],
                'phone'         => 'required',
                'summary'       => 'max:250',
                'about'         => 'required',
                'zipcode'       => 'required',
                'address'       => 'required',
                'district'      => 'required',
                'number'        => 'required',
                'state'         => 'required',
                'city'          => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $data = InputFields::inputFieldsConfiguration($request);
            $result->update($data);

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //update brand
    public static function updateBrand(Request $request)
    {
        try{
            if($request->hasFile('image')) {
                $result = Configuration::findOrFail($request->id);
                if(File::exists(public_path().'/brand/thumb/'.$result->avatar)){
                    File::delete(public_path().'/brand/thumb/'.$result->avatar);
                }
                if(File::exists(public_path().'/brand/'.$result->avatar)){
                    File::delete(public_path().'/brand/'.$result->avatar);
                }

                //get image attr
                $image = $request->file('image');
                $file = $image;
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . random_int(100, 999) .'.' . $extension;
                $path = defineUploadPath('brands', null);

                $data['brand'] = $fileName;
                $result->update($data);

                //upload image
                UploadImage::uploadImage(300, 150,  $file, $fileName, $path);

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
    public static function destroy($config_id)
    {
        $id = base64_decode($config_id);
        $result = Configuration::findOrfail($id);
        if($result){
            $data['status_id'] = canceledRegister();
            $result->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }


    //destroy brand
    public static function destroyBrand($config_id)
    {
        $id = base64_decode($config_id);
        $file = Configuration::findOrfail($id);

        destroyFile('brands', $file->brand, 'thumb');

        if($file){
            $data['brand'] = '';
            $file->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

}
