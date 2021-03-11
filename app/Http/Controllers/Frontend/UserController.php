<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::find(1);
        return view('frontend.profile', compact('user'));
    }
}
