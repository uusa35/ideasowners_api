<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveImage(Request $request, $inputName = 'image', $imageType = 'large', $width = '1150', $height = '360')
    {
        if ($request->hasFile($inputName)) {
            $imageRealPath = $request->$inputName->store('public/uploads/images/' . $imageType);
            $imageRealPath = str_replace('public/', '', $imageRealPath);
            $img = Image::make(storage_path('app/public/' . $imageRealPath));
            $img->resize($width, $height);
            $img->save();
            $imagePath = str_replace('uploads/images/' . $imageType.'/', '', $imageRealPath);
            return $imagePath;
        }
        return null;
    }
}
