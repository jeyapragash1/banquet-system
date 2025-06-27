<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        // Fetch all settings from the database and format as a simple array
        $settings = DB::table('settings')->pluck('value', 'key')->all();

        return view('settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tax_type' => 'required|in:none,percentage,flat',
            'tax_value' => 'required|numeric|min:0',
        ]);

        // Update or create the settings in the database
        DB::table('settings')->updateOrInsert(
            ['key' => 'tax_type'],
            ['value' => $validated['tax_type']]
        );
        DB::table('settings')->updateOrInsert(
            ['key' => 'tax_value'],
            ['value' => $validated['tax_value']]
        );

        return redirect()->route('settings.index')->with('success', 'Settings saved successfully.');
    }
}