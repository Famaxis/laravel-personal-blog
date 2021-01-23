<?php

namespace App\Http\Controllers\Backend;

use App\Services\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Image;


class UserController extends Controller
{
    private $imageHandler;

    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('backend.profile', array('user' => Auth::user()) );
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $this->imageHandler->updateAvatar($request->file('avatar'));
        $user->update($request->all());

        return view('backend.profile', array('user' => Auth::user()) );
    }
}
