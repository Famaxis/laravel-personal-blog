<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ImageHandler;
use Illuminate\Http\Request;

class EditorImageUploadController extends Controller
{
    public function uploadImage (Request $request)
    {
        ImageHandler::handleUploadedImage(
            $request->file('upload'),
            $request->input('CKEditorFuncNum')
        );
    }
}
