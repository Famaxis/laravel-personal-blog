<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ImageHandler;
use Illuminate\Http\Request;

class EditorImageUploadController extends Controller
{
    private $imageHandler;

    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
    }

    public function uploadImage (Request $request)
    {
        $this->imageHandler->handleUploadedImage(
            $request->file('upload'),
            $request->input('CKEditorFuncNum')
        );
    }
}
