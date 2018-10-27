<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactCompany;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\Contacts;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.contact.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Contact;
        $columns = ['id',  'name',  'origin', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('email', function ($data) {
                return Contact::email($data->id);
            })
            ->addColumn('phone', function ($data) {
                return Contact::phone($data->id);
            })
            ->addColumn('origin', function ($data) {
                return quoteOrigin($data->origin);
            })
            ->addColumn('quotes', function ($data) {
                return Contact::quote($data->id) > 0 ? '<span class="badge bg-green">'.Contact::quote($data->id).'</span>  Orçamento(s)' :  '<span class="badge bg-red">0</span> orçamento';
            })
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="'.route('contact-edit', [base64_encode($data->id)]).'"     title="Visualizar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="'.route('contact-destroy', [base64_encode($data->id)]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action', 'quotes'])
            ->toJson();
    }

    //create
    public function create()
    {
        $status = Status::where('flag', 'crm')->get();
        return view('admin.contact.create', compact('status'));
    }

    //store
    public static function store(Request $request)
    {
        try{
            $messages = Messages::msgContactCrm();
            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|min:3|max:100|unique:contacts',
            ], $messages);
            if ($validator->fails()) {
                return response()->json(['status' => 400, 'response', 'error' => $validator->errors()->all()]);
                exit();
            }

            $contact = Contact::create(InputFields::inputFieldsContact($request));

            //save phones
            if($request->phone){
                Contacts::storephone($request, $contact->id);
            }

            //save emails
            if($request->email){
                Contacts::storeEmail($request->email, $contact->id);
            }

            //save company
            if($request->zipcode){
                Contacts::storeCompany($request, $contact->id);
            }

            $msg = ['status' => 1, 'response' => 'Salvo com sucesso!', 'redirect' => route('contact-edit', [base64_encode($contact->id)])];
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao salvar!'];
            return response()->json($msg);
        }
    }

    //edit
    public static function edit($contact_id)
    {
        $id = base64_decode($contact_id);
        $contact = Contact::findOrfail($id);
        $company = ContactCompany::where('contact_id', $id)->first();
        $status = Status::where('flag', 'crm')->get();
        return view('admin.contact.edit', compact('contact', 'status', 'company'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $contact = Contact::findOrFail($request->id);

            $messages = Messages::msgContactCrm();
            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|min:3|max:100|unique:contacts,name,'.$request->id,
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }

            $contact->update(InputFields::inputFieldsContact($request));

            //save phones
            if($request->phone){
                Contacts::storephone($request, $contact->id);
            }

            //save emails
            if($request->email){
                Contacts::storeEmail($request->email, $contact->id);
            }

            //save company
            if($request->zipcode){
                Contacts::storeCompany($request, $contact->id);
            }

            $msg = ['status' => 1, 'response' => 'Salvo com sucesso!'];
            return response()->json($msg);

        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao salvar!'];
            return response()->json($msg);
        }
    }

    //destroy
    public static function destroy($contact_id)
    {
        $id = base64_decode($contact_id);
        $contact = Contact::findOrfail($id);
        if($contact){
            $data['status_id'] = statusOrder('canceled');
            $contact->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
