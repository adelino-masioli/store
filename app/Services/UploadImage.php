<?php

namespace App\Services;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UploadImage
{
    public static function uploadImage($size, $thumb, $file, $fileName, $path)
    {
        $destinationPath = public_path($path);
        $destinationPathThumb = public_path($path.'thumb/');
        $fullPath = $destinationPath.'/'.$fileName;
        $fullPathThumb = $destinationPathThumb.'/'.$fileName;


        if (!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775,true);
        }
        if (!file_exists($destinationPathThumb)) {
            File::makeDirectory($destinationPathThumb, 0775,true);
        }

        //bigimage
        if($size!=null) {
            $image = Image::make($file)
                ->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg');
        }else{
            $image = Image::make($file);
        }
        $image->save($fullPath, 100);

        //thumb
        $image = Image::make($file)
            ->resize($thumb, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
        $image->save($fullPathThumb, 100);

    }


    public static function uploadBanner($size, $thumb, $file, $fileName, $path)
    {
        $destinationPath = public_path($path);
        $destinationPathThumb = public_path($path.'thumb/');
        $destinationPath1400 = public_path($path.'1400/');
        $destinationPath800 = public_path($path.'800/');
        $destinationPath600 = public_path($path.'600/');

        $fullPath = $destinationPath.'/'.$fileName;
        $fullPathThumb = $destinationPathThumb.'/'.$fileName;
        $fullPath1400 = $destinationPath1400.'/'.$fileName;
        $fullPath800 = $destinationPath800.'/'.$fileName;
        $fullPath600 = $destinationPath600.'/'.$fileName;


        if (!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775,true);
        }
        if (!file_exists($destinationPathThumb)) {
            File::makeDirectory($destinationPathThumb, 0775,true);
        }
        if (!file_exists($destinationPath1400)) {
            File::makeDirectory($destinationPath1400, 0775,true);
        }
        if (!file_exists($destinationPath800)) {
            File::makeDirectory($destinationPath800, 0775,true);
        }
        if (!file_exists($destinationPath600)) {
            File::makeDirectory($destinationPath600, 0775,true);
        }

        //bigimage
        if($size!=null) {
            $image = Image::make($file)
                ->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg');
        }else{
            $image = Image::make($file);
        }
        $height = $image->height();
        $image->save($fullPath, 100);

        //thumb
        $image = Image::make($file)
            ->resize($thumb, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
        $image->save($fullPathThumb, 100);

        //1400
        $image = Image::make($file)
            ->fit(1400, $height)
            ->encode('jpg');
        $image->save($fullPath1400, 100);

        //800
        $image = Image::make($file)
            ->fit(800, $height)
            ->encode('jpg');
        $image->save($fullPath800, 100);

        //600
        $image = Image::make($file)
            ->fit(600, $height)
            ->encode('jpg');
        $image->save($fullPath600, 100);

    }


    public static function uploadFile($file, $fileName, $path)
    {
        $destinationPath = public_path($path);


        if (!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775,true);
        }

        $file->move($destinationPath, $fileName);

    }
}