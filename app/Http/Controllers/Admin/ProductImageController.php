<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Services\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        return view('admin.product.home');
    }

    //create
    public static function store(Request $request)
    {
        try{
            if($request->hasFile('image')) {
                $validator = Validator::make($request->all(), [
                    'product_id' => 'required',
                    'name' => 'required|string|max:200',
                    'image' => 'required|mimes:jpeg,jpg,png',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                    exit();
                }

                //get image attr
                $image = $request->file('image');
                $file = $image;
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . random_int(100, 999) .'.' . $extension;
                $path = 'catalog/'.config('app.template').'/';

                ProductImage::create([
                    'product_id' => $request['product_id'],
                    'name' => $request['name'],
                    'image' => $fileName,
                    'is_cover' => $request['is_cover'],
                    'status' => 1,
                ]);

                //upload image
                UploadImage::uploadImage(500, 200,  $file, $fileName, $path);


                session()->flash('success', 'Salvo com sucesso!');
                return redirect()->back();
            }else{
                session()->flash('error', 'Favor selecionar a imagem!');
                return redirect()->back();
            }
        }catch(\Exception $e){
            session()->flash('error_quote', 'Erro ao salvar!');
            return redirect()->back();
        }
    }

    //destroy
    public static function destroy($id)
    {
        $image = ProductImage::findOrfail($id);
        if(File::exists(public_path().'/catalog/'.config('app.template').'/thumb/'.$image->image)){
            File::delete(public_path().'/catalog/'.config('app.template').'/thumb/'.$image->image);
        }
        if(File::exists(public_path().'/catalog/'.config('app.template').'/'.$image->image)){
            File::delete(public_path().'/catalog/'.config('app.template').'/'.$image->image);
        }
        if($image){
            $image->delete();
        }
        session()->flash('success', 'Excluído com sucesso!');
        return redirect()->back();
    }

}
