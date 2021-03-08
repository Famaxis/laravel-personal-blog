<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Artisan;

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
            'confirm_deletion' => request('confirm_deletion'),
            'main_template'    => request('main_template'),
        ]);

        return redirect()->route('settings');
    }

    public function cacheClear()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear ');
        return redirect()->back()->with('status', 'Cache cleared.');
    }

    public function cacheMake()
    {
        Artisan::call('view:cache');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        return redirect()->back()->with('status', 'Everything is cached.');
    }
}
