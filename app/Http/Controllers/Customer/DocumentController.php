<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Status;
use App\Traits\DataTableTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //documents
    public function index($type)
    {

        return view('customer.document.'.$type);
    }

    //get
    public function getDatatable(Request $request, $type_id)
    {
        $model = new \App\Models\Document;
        $columns = ['documents.id',  'documents.name as name', 'documents.type_id', 'file', 'extension',  'documents.created_at',  'documents.updated_at', 'documents.status_id'];
        $result = $model->select($columns)
            ->join('document_users', 'documents.id', 'document_users.document_id')
            ->join('users', 'document_users.user_id', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->where('documents.type_id', $type_id)
            ->where('documents.configuration_id', Auth::user()->configuration_id);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
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
                    return '<a href="' . route('customer-document-download', base64_encode($data->id)) . '"  title="Baixar" class="btn bg-green btn-xs"><i class="fa fa-download"></i></a>';
                }else{
                    return '<a href="javascript:void(0);"  title="Baixar" class="btn bg-green btn-xs disabled"><i class="fa fa-close"></i></a>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="' . route('customer-document-show', [base64_encode($data->id)]) . '"  title="Detalhar" class="btn bg-aqua btn-xs"><i class="fa fa-search"></i> Detalhes</a>';
            })
            ->setRowClass(function ($data) {
                return switchColor($data->status_id);
            })
            ->rawColumns(['action', 'file'])
            ->toJson();
    }

    //show
    public static function show($document_id)
    {
        $id = base64_decode($document_id);
        $document = Document::findOrfail($id);
        return view('customer.document.show', compact('document'));
    }

    public static function download($file_download)
    {
        $file = base64_decode($file_download);
        $document = Document::findOrFail($file);

        $document->update(['status_id'=>statusOrder('download')]);

        $download = defineDownloadPath('documents').'/'.$document->file;

            return response()->download($download, str_slug($document->name, '-').'.'.$document->extension);
    }
}
