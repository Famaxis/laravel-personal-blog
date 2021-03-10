<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserAvatarRequest;
use App\Services\ImageHandler;
use Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function profile()
    {
        return view('backend.profile', array('user' => Auth::user()));
    }

    public function update(UserAvatarRequest $request)
    {
        $user = Auth::user();
        ImageHandler::updateAvatar($request->file('avatar'));
        $user->update($request->all());

        return back();
    }

    public function changePassword(UserPasswordRequest $request)
    {
        $user = Auth::user();
        $user->update(['password' => Hash::make($request->new_password)]);

        return back();
    }
}
