<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function edit()
    {
        $data = Settings::latest()->first();
        return view('admin.settings.edit', ['title' => 'Update Settings', 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'twitter' => 'nullable',
            'pinterest' => 'nullable',
            'youtube' => 'nullable',
            'rate' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $settings = Settings::updateOrCreate(
            ['id' => $request->id ?? ''],
            [
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'pinterest' => $request->pinterest,
                'youtube' => $request->youtube,
                'rate' => $request->rate,
            ]
        );

        // Optionally, you can redirect the user to a specific route after successful update
        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully');
    }
}
