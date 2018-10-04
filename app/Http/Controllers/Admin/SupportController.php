<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\SupportAnswer;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\UploadImage;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupportController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.support.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Support;
        $columns = ['id',  'title',  'file', 'click', 'extension',  'created_at', 'status_id'];
        $result = $model->select($columns)->where('configuration_id', Auth::user()->configuration_id);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })

            ->addColumn('created_at', function ($data) {
                return format_date($data->created_at);
            })
            ->addColumn('file', function ($data) {
                if($data->file) {
                    return '<a href="' . route('support-download', base64_encode($data->file)) . '"  title="Baixar" class="btn bg-green btn-xs"><i class="fa fa-download"></i></a>';
                }else{
                    return '<a href="javascript:void(0);"  title="Baixar" class="btn bg-green btn-xs disabled"><i class="fa fa-close"></i></a>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="' . route('support-show', [base64_encode($data->id)]) . '" title="Visualizar" class="btn bg-aqua btn-xs"><i class="fa fa-eye"></i> Visualizar</a>';
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
        return view('admin.support.create');
    }


    //store
    public static function store(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $messages = Messages::msgSupport();
                $validator = Validator::make($request->all(), [
                    'title'            => 'required|string|min:5|max:100',
                    'description'      => 'required',
                    'file'             => 'mimes:jpeg,jpg,png,pdf,docx,doc',
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
                $path = defineUploadPath('supports', null);
                $size =  convertFileSize($image->getSize());


                Support::create(InputFields::inputFieldsSupport($request, $extension, $size,  $fileName));

                //upload file
                UploadImage::uploadFile($file, $fileName, $path);

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                $messages = Messages::msgSupport();
                $validator = Validator::make($request->all(), [
                    'title'            => 'required|string|min:5|max:100',
                    'description'      => 'required',
                    'file'             => 'mimes:jpeg,jpg,png,pdf,docx,doc',
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                    exit();
                }
                Support::create(InputFields::inputFieldsSupport($request, null, null,  null));

                session()->flash('success', 'Salvo com sucesso!');
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
        $support = Support::findOrfail($id);

        return view('admin.support.edit', compact('support'));
    }


    //show
    public static function show($document_id)
    {
        $id = base64_decode($document_id);
        $support = Support::findOrfail($id);
        $support_answers = SupportAnswer::where('support_id', $id)->get();
        if($support->click != 1) {
            $support->update(['click' => 1]);
        }

        return view('admin.support.show', compact('support', 'support_answers'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $support = Support::findOrFail($request->id);

                $messages = Messages::msgSupport();
                $validator = Validator::make($request->all(), [
                    'title'            => 'required|string|min:5|max:100',
                    'description'      => 'required',
                    'file'             => 'mimes:jpeg,jpg,png,pdf,docx,doc',
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
                $path = defineUploadPath('supports', null);
                $size =  convertFileSize($image->getSize());

                $data = InputFields::inputFieldsSupport($request, $extension, $size,  $fileName);
                $support->update($data);

                UploadImage::uploadFile($file, $fileName, $path);

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                $support = Support::findOrFail($request->id);

                $messages = Messages::msgSupport();
                $validator = Validator::make($request->all(), [
                    'title'            => 'required|string|min:5|max:100',
                    'description'      => 'required',
                    'file'             => 'mimes:jpeg,jpg,png,pdf,docx,doc',
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                    exit();
                }

                $data = InputFields::inputFieldsSupport($request, null, null,  null);
                $support->update($data);
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
        $file = Support::findOrfail($id);
        destroyFile('supports', $file->file, null);

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
        $file = Support::findOrfail($id);
        destroyFile('supports', $file->file, null);

        if($file){
            $data = [
                'file' => '',
                'extension' => '',
                'size' => '',
            ];
            $file->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

    public static function download($file_download)
    {
        $file = base64_decode($file_download);
        $download = defineDownloadPath('supports').'/'.$file;
        return response()->download($download, $file);
    }


    //answer
    public static function answer(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $messages = Messages::msgSupportAnswer();
                $validator = Validator::make($request->all(), [
                    'description'      => 'required',
                    'file'             => 'mimes:jpeg,jpg,png,pdf,docx,doc',
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
                $path = defineUploadPath('supports', null);
                $size =  convertFileSize($image->getSize());


                SupportAnswer::create(InputFields::inputFieldsSupportAnswer($request, $extension, $size,  $fileName));

                //upload file
                UploadImage::uploadFile($file, $fileName, $path);

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                $messages = Messages::msgSupport();
                $validator = Validator::make($request->all(), [
                    'description'      => 'required',
                    'file'             => 'mimes:jpeg,jpg,png,pdf,docx,doc',
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                    exit();
                }
                SupportAnswer::create(InputFields::inputFieldsSupportAnswer($request, null, null,  null));

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //close suport
    public static function close($document_id)
    {
        $id = base64_decode($document_id);
        $file = Support::findOrfail($id);
        destroyFile('supports', $file->file, null);

        if($file){
            $data = [
                'status_id' =>  statusOrder('closed')
            ];
            $file->update($data);
        }
        session()->flash('success', 'O chamado foi fechado com sucesso!');
        return redirect()->back();
    }
}
