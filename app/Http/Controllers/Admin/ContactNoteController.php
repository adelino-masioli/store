<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactCompany;
use App\Models\ContactNote;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\Contacts;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ContactNoteController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index($contact)
    {
        $notes = ContactNote::with('user')->where('contact_id', $contact)->where('status_id', statusOrder('active'))->orderBy('id', 'desc')->get();
        return $notes;
    }

    //store
    public static function store(Request $request)
    {
        try{
            $messages = [
                'note.required'        => 'Favor informar a ANOTAÇÃO'
            ];

            $validator = Validator::make($request->all(), [
                'note'          => 'required',
            ], $messages);
            if ($validator->fails()) {
                return response()->json(['status' => 400, 'response', 'error' => $validator->errors()->all()]);
                exit();
            }
            $data = [
                'note'       => $request->note,
                'contact_id' => $request->id,
                'user_id'    => Auth::user()->id,
                'status_id'  => statusOrder('active')
            ];
            ContactNote::create($data);


            $msg = ['status' => 1, 'response' => 'Salvo com sucesso!'];
            return response()->json($msg);
        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao salvar!'];
            return response()->json($msg);
        }
    }


    //update
    public static function update(Request $request)
    {
        try{
            $contact = ContactNote::findOrFail($request->note_id);

            $messages = [
                'note.required'        => 'Favor informar a ANOTAÇÃO'
            ];
            $validator = Validator::make($request->all(), [
                'note'          => 'required',
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }

            $data = [
                'note'       => $request->note
            ];

            $contact->update($data);


            $msg = ['status' => 1, 'response' => 'Salvo com sucesso!'];
            return response()->json($msg);

        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao salvar!'];
            return response()->json($msg);
        }
    }

    //destroy
    public static function destroy(Request $request)
    {
        try{
            $note = ContactNote::findOrfail($request->note_id);
            if($note){
                $data = [
                    'status_id'       => statusOrder('canceled')
                ];

                $note->update($data);
            }
            $msg = ['status' => 1, 'response' => 'Salvo com sucesso!'];
            return response()->json($msg);

        }catch(\Exception $e){
            $msg = ['status' => 2, 'response' => 'Erro ao excluir!'];
            return response()->json($msg);
        }
    }
}
