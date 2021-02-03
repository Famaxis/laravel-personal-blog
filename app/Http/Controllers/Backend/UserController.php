<?php

namespace App\Http\Controllers\Backend;

use App\Services\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    private $imageHandler;
    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
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

        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new CurrentPassword],
            'new_password' => ['required'],
        ]);

        $user = Auth::user();
        $user->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back();
    }
}
