<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactAttachment;
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

class ContactAttachmentController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index($contact)
    {
        $notes = ContactAttachment::where('contact_id', $contact)->orderBy('id', 'desc')->get();
        return $notes;
    }


    //store
    public static function store(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $messages = Messages::msgAttachment();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:3',
                    'file'             => 'required|mimes:jpeg,jpg,png,pdf,docx,doc',
                ], $messages);
                if ($validator->fails()) {
                    return response()->json(['status' => 400, 'response', 'error' => $validator->errors()->all()]);
                    exit();
                }

                //get file attr
                $image = $request->file('file');
                $file = $image;
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . random_int(100, 999) .'.' . $extension;
                $path = defineUploadPath('attachments', null);
                $size =  convertFileSize($image->getSize());

                ContactAttachment::create(InputFields::inputFieldsAttachement($request, $extension, $size,  $fileName));

                //upload file
                UploadImage::uploadFile($file, $fileName, $path);


                $msg = ['status' => 1, 'response' => 'Salvo com sucesso!'];
                return response()->json($msg);
            }else{
                $msg = ['status' => 2, 'response' => 'Favor selecionar o arquivo!'];
                return response()->json($msg);
            }
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao salvar!'];
            return response()->json($msg);
        }
    }

    //update
    public static function update(Request $request)
    {
        try{
            if($request->hasFile('file')) {
                $res = ContactAttachment::findOrFail($request->attachment_id);

                //destroy file
                destroyFile('attachments', $res->file, 'thumb');

                $messages = Messages::msgAttachment();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:3',
                    'file'             => 'required|mimes:jpeg,jpg,png,pdf,docx,doc',
                ], $messages);
                if ($validator->fails()) {
                    return response()->json(['status' => 400, 'response', 'error' => $validator->errors()->all()]);
                    exit();
                }

                //get file attr
                $image = $request->file('file');
                $file = $image;
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . random_int(100, 999) .'.' . $extension;
                $path = defineUploadPath('attachments', null);
                $size =  convertFileSize($image->getSize());

                $data = InputFields::inputFieldsAttachement($request, $extension, $size,  $fileName);
                $res->update($data);

                UploadImage::uploadFile($file, $fileName, $path);

                $msg = ['status' => 1, 'response' => 'Salvo com sucesso!'];
                return response()->json($msg);
            }else{
                $res = ContactAttachment::findOrFail($request->attachment_id);

                $messages = Messages::msgAttachment();
                $validator = Validator::make($request->all(), [
                    'name'             => 'required|string|min:3',
                ], $messages);
                if ($validator->fails()) {
                    return response()->json(['status' => 400, 'response', 'error' => $validator->errors()->all()]);
                    exit();
                }

                $data = InputFields::inputFieldsAttachement($request, null, null, null);
                $res->update($data);

                $msg = ['status' => 1, 'response' => 'Salvo com sucesso!'];
                return response()->json($msg);
            }
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao salvar!'];
            return response()->json($msg);
        }
    }


    //destroy
    public static function destroy(Request $request)
    {
        try{
            $res = ContactAttachment::findOrFail($request->attachment_id);

            //destroy file
            destroyFile('attachments', $res->file, 'thumb');

            if($res){
                $res->delete();
            }
            $msg = ['status' => 1, 'response' => 'Salvo com sucesso!'];
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao excluir!'];
            return response()->json($msg);
        }
    }


    public static function download($download_file)
    {
        $file = $download_file;
        $download = defineDownloadPath('attachments').'/'.$file;
        return response()->download($download, $file);

    }
}
