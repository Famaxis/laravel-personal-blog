<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('backend.settings', compact('settings'));
    }

    public function update()
    {
        $settings = Setting::first();
        $settings->update([
            'site_name'        => request('site_name'),
            'comments_allowed' => request('comments_allowed'),
            'main_template' => request('main_template'),
        ]);

        return redirect()->route('settings');
    }
}
