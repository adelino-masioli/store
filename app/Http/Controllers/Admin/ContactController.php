<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
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
        $model = Contact::select(['id',  'name', 'email', 'phone', 'about', 'status',])->where('status', '!=', 3);

        return DataTables::eloquent($model)
            ->addColumn('status', function ($data) {
                return $data->status== 1 ? 'Aberto' : 'Concluído';
            })
            ->addColumn('action', function ($data) {
                return '<a onclick="localStorage.clear();" href="'.route('contact-edit', [$data->id]).'"     title="Visualizar" class="btn bg-aqua btn-xs"><i class="fa fa-envelope-open-o"></i></a>
                        <a href="'.route('contact-destroy', [$data->id]).'"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->toJson();
    }

    //edit
    public static function edit($id)
    {
        $contact = Contact::findOrfail($id);
        return view('admin.contact.edit', compact('contact'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            $category = Contact::findOrFail($request->id);

            $data = [
                'status'           => $request['status']
            ];
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
        $category = Contact::findOrfail($id);
        if($category){
            $data['status'] = 3;
            $category->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
