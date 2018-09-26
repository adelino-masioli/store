<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Document;
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
        $columns = ['id',  'name',  'file', 'extension',  'created_at', 'updated_at', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('user', function ($data) {
                return Document::user($data->id) ? Document::user($data->id)  : '--';
            })
            ->addColumn('created_at', function ($data) {
                return format_date($data->created_at);
            })
            ->addColumn('updated_at', function ($data) {
                return format_date($data->updated_at);;
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="'.route('document-edit', [$data->id]).'"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="'.route('document-destroy', [$data->id]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->addColumn('file', function ($data) {
                return '<a href="'.route('document-download', $data->file).'"  title="Baixar" class="btn bg-green btn-xs"><i class="fa fa-download"></i></a>';
            })
            ->rawColumns(['action', 'file'])
            ->toJson();
    }

    //create
    public function create()
    {
        $status = Status::where('flag', 'document')->get();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }
        return view('admin.document.create', compact('status','configurations', 'users'));
    }


    //store
    public static function store(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $messages = Messages::msgDocument();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:5|max:100',
                    'type'             => 'required',
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
                $path = 'downloads/'.config('app.template').'/';
                $size =  convertFileSize($image->getSize());


                $document = Document::create(InputFields::inputFieldsDocument($request, $extension, $size,  $fileName));

                //upload file
                UploadImage::uploadFile($file, $fileName, $path);

                DocumentUser::create(['user_id'=>Auth::user()->id,'document_id'=>$document->id]);

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
    public static function edit($id)
    {
        $category = Document::findOrfail($id);
        $status = Status::where('flag', 'default')->get();
        $profile = Auth::user()->type_id;
        if($profile > 1){
            $configurations = '';
        }else{
            $configurations = Configuration::get();
        }

        return view('admin.document.edit', compact('category', 'status','configurations'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $category = Document::findOrFail($request->id);

            $messages = Messages::msgCategory();
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|min:5|max:100',
                'description'      => 'required',
                'file'             => 'required|mimes:jpeg,jpg,png,pdf,docx,doc',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
                exit();
            }
            $data = InputFields::inputFieldsDocument($request);
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
        $file = Document::findOrfail($id);
        if(File::exists(public_path().'/downloads/'.config('app.template').'/'.$file->file)){
            File::delete(public_path().'/downloads/'.config('app.template').'/'.$file->file);
        }
        if($file){
            $file->delete();
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

    public static function download($file)
    {
        $download = public_path().'/downloads/'.config('app.template').'/'.$file;
        return response()->download($download, $file);
    }
}
