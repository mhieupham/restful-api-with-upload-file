<?php
namespace App\Services;

use App\Contracts\UploadFile;

class UploadImageService implements UploadFile
{
    public function uploadImage($image)
    {
        $newImage = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'),$newImage);
        return $newImage;
    }
}
