<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function checkFolderExist($folder) {
        if (!file_exists($folder)) {
            mkdir($folder, 755, true);
        }
    }

    function saveImage($file, $filePath, $changeName, $width = null, $height = null)
    {
        if (!File::isDirectory($filePath)) {
            File::makeDirectory($filePath, 0777, true, true);
        }
        
        $img = Image::make($file->path());
        $img->resize($width, $height, function ($const) {
            $const->aspectRatio();
            $const->upsize();
        })->save($filePath . $changeName);
    }
}
