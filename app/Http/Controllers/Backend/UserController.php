<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Image;
use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('backend.profile', array('user' => Auth::user()) );
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save( public_path('/avatar/' . $filename ) );


            $user->avatar = $filename;
            $user->save();
        }

        $user->update($request->all());

        return view('backend.profile', array('user' => Auth::user()) );
    }
}
