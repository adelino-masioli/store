<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Status;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\UploadImage;
use App\Traits\DataTableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.page.home');
    }

    //get
    public function getDatatable(Request $request)
    {
        $model = new \App\Models\Page;
        $columns = ['id',  'title',  'type', 'show_form',  'status_id'];
        $result  = $this->dataTable($model, $columns);

        return DataTables::eloquent($result)
            ->addColumn('type', function ($data) {
                return switchPage($data->type);
            })
            ->addColumn('show_form', function ($data) {
                return $data->show_form == 0 ? 'Não' : 'Sim';
            })
            ->addColumn('status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('action', function ($data) {
                if($data->status_id == canceledRegister()) {
                    return '<a onclick="localStorage.clear();" href="' . route('page-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>';
                }else{
                    return '<a onclick="localStorage.clear();" href="' . route('page-edit', [base64_encode($data->id)]) . '"     title="Editar" class="btn bg-aqua btn-xs"><i class="fa fa-pencil"></i></a>';
                }
            })
            ->rawColumns(['action', 'file'])
            ->toJson();
    }

    //edit
    public static function edit($banner_id)
    {
        $id = base64_decode($banner_id);
        $page = Page::findOrfail($id);
        $status = Status::where('flag', 'default')->get();
        return view('admin.page.edit', compact('page', 'status'));
    }


    //update
    public static function update(Request $request)
    {
        try{
            if($request->hasFile('banner')) {
                $banner = Page::findOrFail($request->id);

                $messages = Messages::msgPage();
                $validator = Validator::make($request->all(), [
                    'title'            => 'required|string|min:5|max:20|unique:pages,title,'.$request['id'],
                    'summary'          => 'max:300',
                    'banner'           => 'mimes:jpeg,jpg,png',
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                    exit();
                }

                //get file attr
                $image = $request->file('banner');
                $file = $image;
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . random_int(100, 999) .'.' . $extension;
                $path = defineUploadPath('pages', null);
                $size =  convertFileSize($image->getSize());

                $data = InputFields::inputFieldsPage($request,  $fileName);
                $banner->update($data);

                UploadImage::uploadImage(1920, 100, $file, $fileName, $path);

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                $banner = Page::findOrFail($request->id);

                $messages = Messages::msgPage();
                $validator = Validator::make($request->all(), [
                    'title'            => 'required|string|min:5|max:50|unique:pages,title,'.$request['id'],
                    'banner'           => 'mimes:jpeg,jpg,png'
                ], $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                    exit();
                }

                $data = InputFields::inputFieldsPage($request, null);
                $banner->update($data);

                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }
        }catch(\Exception $e){
            session()->flash('error', 'Erro ao salvar!');
            return redirect()->back();
        }
    }


    //destroy
    public static function destroy($banner_id)
    {
        $id = base64_decode($banner_id);
        $file = Page::findOrfail($id);
        //destroy file
        destroyFile('pages', $file->banner, 'thumb');

        if($file){
            $file->delete();
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

    //destroy file
    public static function destroyFile($banner_id)
    {
        $id = base64_decode($banner_id);
        $file = Page::findOrfail($id);

        destroyFile('pages', $file->banner, 'thumb');

        if($file){
            $file->update(['banner' => '']);
        }
        session()->flash('success', 'Banner excluído com sucesso!');
        return redirect()->back();
    }

}
