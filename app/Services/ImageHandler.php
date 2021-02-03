<?php

namespace App\Services;

use Auth;
use Illuminate\Support\Facades\Storage;

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

            $url = asset('images/' . $fileName);
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";

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

            if ($user->avatar) {
                // deleting previous avatar
                Storage::disk('public')->delete('/avatar/' . $user->avatar);
            }

            $avatar->move(public_path('avatar'), $filename);
            $user->avatar = $filename;
            $user->save();
        }
    }
}