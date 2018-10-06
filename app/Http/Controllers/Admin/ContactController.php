<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Status;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
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
        $columns = ['id',  'name', 'email', 'phone', 'about', 'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="'.route('contact-edit', [base64_encode($data->id)]).'"     title="Visualizar" class="btn bg-aqua btn-xs"><i class="fa fa-envelope-open-o"></i></a>
                        <a href="'.route('contact-destroy', [base64_encode($data->id)]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->toJson();
    }

    //edit
    public static function edit($contact_id)
    {
        $id = base64_decode($contact_id);
        $contact = Contact::findOrfail($id);
        $status = Status::where('flag', 'reader')->get();
        return view('admin.contact.edit', compact('contact', 'status'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $contact = Contact::findOrFail($request->id);

            $data = [
                'status_id'           => $request['status_id']
            ];
            $contact->update($data);

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //destroy
    public static function destroy($contact_id)
    {
        $id = base64_decode($contact_id);
        $contact = Contact::findOrfail($id);
        if($contact){
            $data['status_id'] = 3;
            $contact->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
