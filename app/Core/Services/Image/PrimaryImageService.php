<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/1/15
 * Time: 12:09 PM
 */

namespace App\Core\Services\Image;


use App\Core\Services\Image\PrimaryImageServiceInterface;

class PrimaryImageService 
{

    public function CreateImage($currentImage, $thumbResize, $largeResize)
    {
        try {
            $fileName = $currentImage->getClientOriginalName();

            $fileName = str_replace(' ', '', $fileName);

            $fileName = trim(rand(0, 10000) . '' . e($fileName));

            $realPath = $currentImage->getRealPath();

            \Image::make($realPath)->resize($thumbResize[0],
                $thumbResize[1])->save(public_path('img/uploads/thumbnail/' . $fileName));

            \Image::make($realPath)->resize($largeResize[0],
                $largeResize[1])->save(public_path('img/uploads/large/' . $fileName));

            return $fileName;

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}