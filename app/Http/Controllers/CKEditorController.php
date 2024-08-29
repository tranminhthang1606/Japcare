<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CKEditorController extends Controller
{
    //
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $monthYearCurrent = date('dmY');
            $filePath = public_path("storage/uploads/post/$monthYearCurrent/");
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }

            $changeName = Str::random(15).'.'.$request->file('upload')->getClientOriginalExtension();
            $img = Image::make($request->file('upload')->path());
            $img->resize(760, null, function ($const) {
                $const->aspectRatio();
                $const->upsize();
            })->save($filePath.$changeName);
            $imagePath = asset("storage/uploads/post/$monthYearCurrent/".$changeName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $msg = 'Tải ảnh thành công!';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$imagePath', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;

        }
    }

}
