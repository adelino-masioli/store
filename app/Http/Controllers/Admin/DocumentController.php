<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentUser;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\UploadImage;
use App\Traits\DataTableTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.document.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Document;
        $columns = ['id',  'name',  'file', 'extension',  'created_at', 'type_id', 'updated_at', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('user', function ($data) {
                return Document::user($data->id) ? Document::user($data->id)  : '--';
            })
            ->addColumn('type', function ($data) {
                return $data->type->type;
            })
            ->addColumn('created_at', function ($data) {
                return format_date($data->created_at);
            })
            ->addColumn('updated_at', function ($data) {
                return format_date($data->updated_at);;
            })
            ->addColumn('file', function ($data) {
                if($data->file) {
                    return '<a href="' . route('document-download', base64_encode($data->file)) . '"  title="Baixar" class="btn bg-green btn-xs"><i class="fa fa-download"></i></a>';
                }else{
                    return '<a href="javascript:void(0);"  title="Baixar" class="btn bg-green btn-xs disabled"><i class="fa fa-close"></i></a>';
                }
            })
            ->addColumn('action', function ($data) {
                if($data->status_id == canceledRegister()) {
                    return '<a onclick="localStorage.clear();" href="' . route('document-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                         <a href="javascript:void(0);"  title="Excluir" class="btn bg-red btn-xs disabled"><i class="fa fa-trash"></i></a>
                        ';
                }else{
                    return '<a onclick="localStorage.clear();" href="' . route('document-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="' . route('document-destroy', [base64_encode($data->id)]) . '"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
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
        $status = Status::where('flag', 'document')->get();
        $users = User::where('id', '!=', Auth::user()->id)
            ->where('configuration_id', '!=', '')
            ->where('configuration_id', Auth::user()->configuration_id)
            ->get();
        $doc_types = DocumentType::get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        return view('admin.document.create', compact('status','configurations', 'users', 'doc_types'));
    }


    //store
    public static function store(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $messages = Messages::msgDocument();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:5|max:100',
                    'type_id'           => 'required',
                    'description'      => 'required',
                    'file'             => 'required|mimes:jpeg,jpg,png,pdf,docx,doc',
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
                $path = defineUploadPath('documents', null);
                $size =  convertFileSize($image->getSize());


                $document = Document::create(InputFields::inputFieldsDocument($request, $extension, $size,  $fileName));

                //upload file
                UploadImage::uploadFile($file, $fileName, $path);

                DocumentUser::create(['user_id'=>$request['user_id'],'document_id'=>$document->id]);

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
    public static function edit($document_id)
    {
        $id = base64_decode($document_id);
        $document = Document::findOrfail($id);
        $status = Status::where('flag', 'default')->get();
        $users = User::where('id', '!=', Auth::user()->id)
            ->where('configuration_id', '!=', '')
            ->where('configuration_id', Auth::user()->configuration_id)
            ->get();
        $doc_types = DocumentType::get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }

        return view('admin.document.edit', compact('document', 'status','configurations', 'users', 'doc_types'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $document = Document::findOrFail($request->id);

                $messages = Messages::msgDocument();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:5|max:100',
                    'type_id'           => 'required',
                    'description'      => 'required',
                    'file'             => 'required|mimes:jpeg,jpg,png,pdf,docx,doc',
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
                $path = defineUploadPath('documents', null);
                $size =  convertFileSize($image->getSize());

                $data = InputFields::inputFieldsDocument($request, $extension, $size,  $fileName);
                $document->update($data);

                UploadImage::uploadFile($file, $fileName, $path);

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                $document = Document::findOrFail($request->id);

                $messages = Messages::msgDocument();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:5|max:100',
                    'type_id'          => 'required',
                    'description'      => 'required'
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                    exit();
                }

                $data = InputFields::inputFieldsDocument($request, null, null,  null);
                $document->update($data);
                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //destroy
    public static function destroy($document_id)
    {
        $id = base64_decode($document_id);
        $file = Document::findOrfail($id);
        destroyFile('documents', $file->file, null);

        if($file){
            $file->delete();
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

    //destroy file
    public static function destroyFile($document_id)
    {
        $id = base64_decode($document_id);
        $file = Document::findOrfail($id);
        destroyFile('documents', $file->file, null);

        if($file){
            $file->update(['file' => '']);
        }
        session()->flash('success', 'Documento excluído com sucesso!');
        return redirect()->back();
    }

    public static function download($file_download)
    {
        $file = base64_decode($file_download);
        $download = defineDownloadPath('documents').'/'.$file;
        return response()->download($download, $file);
    }
}
