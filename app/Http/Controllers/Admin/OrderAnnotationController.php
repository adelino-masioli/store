<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderAnnotation;
use App\Services\InputFields;
use App\Services\Messages;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderAnnotationController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //store
    public static function store(Request $request)
    {
        try{
            $messages = Messages::msgOrderAnnotation();
            $validator = Validator::make($request->all(), [
                'description'      => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                exit();
            }
            OrderAnnotation::create(InputFields::inputFieldsOrderAnnotation($request));

            session()->flash('success', 'Salvo com sucesso!');
            return redirect()->back();
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //open
    public static function open($annotation_id)
    {
        $id = base64_decode($annotation_id);
        $res = OrderAnnotation::findOrfail($id);
        if($res){
            $data['status_id'] = statusOrder('closed');
            $res->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

    //destroy
    public static function destroy($annotation_id)
    {
        $id = base64_decode($annotation_id);
        $res = OrderAnnotation::findOrfail($id);
        if($res){
            $data['status_id'] = canceledRegister();
            $res->update($data);
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }
}
