<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'map_iframe' => Setting::get('map_iframe'),
            'whatsapp_number' => Setting::get('whatsapp_number'),
        ];
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        Setting::set('map_iframe', $request->map_iframe);
        Setting::set('whatsapp_number', $request->whatsapp_number);

        return redirect()->back()->with('message', 'Ayarlar uğurla yeniləndi');
    }
}
