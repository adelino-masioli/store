<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use App\Models\Midia;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\UploadImage;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MidiaController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.midia.home');
    }

    //modal
    public function modal()
    {
        $midias = Midia::select('id', 'file')->where('status_id', 1)->get();
        return $midias;
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Midia;
        $columns = ['id',  'name',  'file', 'extension',  'created_at', 'updated_at', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('created_at', function ($data) {
                return format_date($data->created_at);
            })
            ->addColumn('updated_at', function ($data) {
                return format_date($data->updated_at);;
            })
            ->addColumn('file', function ($data) {
                if($data->file) {
                    return '<a href="' . route('midia-download', base64_encode($data->file)) . '"  title="Baixar" class="btn bg-green btn-xs"><i class="fa fa-download"></i></a>';
                }else{
                    return '<a href="javascript:void(0);"  title="Baixar" class="btn bg-green btn-xs disabled"><i class="fa fa-close"></i></a>';
                }
            })
            ->addColumn('action', function ($data) {
                if($data->status_id == canceledRegister()) {
                    return '<a onclick="localStorage.clear();" href="' . route('midia-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                         <a href="javascript:void(0);"  title="Excluir" class="btn bg-red btn-xs disabled"><i class="fa fa-trash"></i></a>
                        ';
                }else{
                    return '<a onclick="localStorage.clear();" href="' . route('midia-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="' . route('midia-destroy', [base64_encode($data->id)]) . '"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
                }
            })
            ->setRowClass(function ($data) {
                return switchColor($data->status_id);
            })
            ->rawColumns(['action', 'file'])
            ->toJson();
    }

    //create
    public function create()
    {
        $status = Status::where('flag', 'default')->get();
        return view('admin.midia.create', compact('status'));
    }


    //store
    public static function store(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $messages = Messages::msgMidia();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:5|max:50',
                    'description'      => 'required',
                    'file'             => 'required|mimes:jpeg,jpg,png',
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                    exit();
                }

                //get file attr
                $image = $request->file('file');
                $file = $image;
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . random_int(100, 999) .'.' . $extension;
                $path = defineUploadPath('midias', null);
                $size =  convertFileSize($image->getSize());

                Midia::create(InputFields::inputFieldsMidia($request, $extension, $size,  $fileName));

                //upload file
                UploadImage::uploadImage(null, 100, $file, $fileName, $path);


                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                session()->flash('error', 'Favor selecionar o arquivo!');
                return redirect()->back();
            }
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //edit
    public static function edit($midia_id)
    {
        $id = base64_decode($midia_id);
        $midia = Midia::findOrfail($id);
        $status = Status::where('flag', 'default')->get();
        $doc_types = DocumentType::get();
        return view('admin.midia.edit', compact('midia', 'status', 'doc_types'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $banner = Midia::findOrFail($request->id);

                $messages = Messages::msgMidia();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:5|max:50',
                    'description'      => 'required',
                    'file'             => 'required|mimes:jpeg,jpg,png',
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                    exit();
                }

                //get file attr
                $image = $request->file('file');
                $file = $image;
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . random_int(100, 999) .'.' . $extension;
                $path = defineUploadPath('midias', null);
                $size =  convertFileSize($image->getSize());

                $data = InputFields::inputFieldsMidia($request, $extension, $size,  $fileName);
                $banner->update($data);

                UploadImage::uploadImage(null, 100, $file, $fileName, $path);

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                $banner = Midia::findOrFail($request->id);

                $messages = Messages::msgBanner();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:5|max:50',
                    'description'      => 'required',
                    'file'             => 'required|mimes:jpeg,jpg,png',
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                    exit();
                }

                $data = InputFields::inputFieldsBanner($request, null, null, null);
                $banner->update($data);

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //destroy
    public static function destroy($midia_id)
    {
        $id = base64_decode($midia_id);
        $file = Midia::findOrfail($id);
        //destroy file
        destroyFile('midias', $file->file, 'thumb');

        if($file){
            $file->delete();
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

    //destroy file
    public static function destroyFile($midia_id)
    {
        $id = base64_decode($midia_id);
        $file = Midia::findOrfail($id);

        destroyFile('midias', $file->file, 'thumb');

        if($file){
            $file->update(['file' => '']);
        }
        session()->flash('success', 'Documento excluído com sucesso!');
        return redirect()->back();
    }

    public static function download($download_file)
    {
        $file = base64_decode($download_file);
        $download = defineDownloadPath('midias').'/'.$file;
        return response()->download($download, $file);
    }
}
