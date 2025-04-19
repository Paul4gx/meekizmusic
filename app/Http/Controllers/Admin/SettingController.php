<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = AdminSetting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'currency' => 'required|string|max:255',
            'contact_info' => 'required|array',
            'contact_info.email' => 'required|email',
            'contact_info.phone' => 'nullable|string',
            'contact_info.address' => 'nullable|string',
            'next_beat_release' => 'nullable|date',
            'quick_search' => 'nullable|array',
            'quick_search.*' => 'string'
        ]);

        $settings = AdminSetting::first() ?? new AdminSetting();
        $settings->fill($validated);
        $settings->save();

        // Clear config cache
        Cache::forget('config');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
} 