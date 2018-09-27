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
        $fullPath = $destinationPath.$fileName;
        $fullPathThumb = $destinationPathThumb.$fileName;

        if (!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775,true);
        }
        if (!file_exists($destinationPathThumb)) {
            File::makeDirectory($destinationPathThumb, 0775,true);
        }

        //bigimage
        $image = Image::make($file)
            ->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');

        $image->save($fullPath, 100);

        //thumb
        $image = Image::make($file)
            ->resize($thumb, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
        $image->save($fullPathThumb, 100);

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