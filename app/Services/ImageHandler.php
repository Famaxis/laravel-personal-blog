<?php

namespace App\Services;

use Auth;
use Image;

class ImageHandler
{
    public function handleUploadedImage($image, $CKEditorFuncNum)
    {
        if ($image !== null) {
        $originName = $image->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $fileName = $fileName . '.' . $extension;

        $image->move(public_path('images'), $fileName);

//            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('images/' . $fileName);
        $msg = 'Image uploaded successfully';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
        exit;
        }
    }

    public function updateAvatar($avatar)
    {
        $user = Auth::user();

        if ($avatar !== null) {
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/avatar/' . $filename));

            $user->avatar = $filename;
            $user->save();
        }
    }
}