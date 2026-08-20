<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminContactController extends Controller
{
    /**
     * Show store contact & social media configuration
     */
    public function index()
    {
        $settings = Setting::getAll();

        return view('admin.contacts.index', compact('settings'));
    }

    /**
     * Update store contacts and social media settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'whatsapp_number' => 'nullable|string|max:50',
            'whatsapp_greeting' => 'nullable|string|max:500',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
        ]);

        // Clean WhatsApp number (remove +, spaces, dashes for clean wa.me redirection)
        if (! empty($validated['whatsapp_number'])) {
            $cleanedWa = preg_replace('/[^0-9]/', '', $validated['whatsapp_number']);
            // If starts with 03..., convert to 923...
            if (str_starts_with($cleanedWa, '03')) {
                $cleanedWa = '92'.substr($cleanedWa, 1);
            }
            $validated['whatsapp_number'] = $cleanedWa;
        }

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        Cache::forget('store_all_settings');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Store Contacts & Social Media settings updated successfully in real-time!',
                'settings' => Setting::getAll(),
            ]);
        }

        return redirect()->back()->with('success', 'Store Contacts & Social Media settings updated successfully in real-time!');
    }
}
