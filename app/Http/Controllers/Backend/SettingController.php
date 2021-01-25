<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.settings.index');
    }

    public function update(Request $request)
    {
        $settings = $request->input('name');
//        Config::set('settings.site_name', $settings);
        config(['settings.site_name' => $settings]);

        return redirect()->route('settings');
//        return view('backend.settings.index');
    }
}
