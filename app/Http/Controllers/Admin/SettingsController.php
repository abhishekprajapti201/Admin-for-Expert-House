<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderFooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function header()
    {
        $settings = HeaderFooter::all();

        return view('admin.Headers.ManageHeader', compact('settings'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|file',
            'whatsapp_no' => 'nullable|string|max:20',
            'phone_no' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'whatsappIcon' => 'nullable|string|max:50',
            'phoneIcon' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/settings');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $imageName);
            $data['logo'] = $imageName;
        }

        HeaderFooter::create($data);

        return back()
            ->with('success', 'Settings created successfully!');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'whatsapp_no' => 'nullable|string|max:20',
            'phone_no' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'whatsappIcon' => 'nullable|string|max:50',
            'phoneIcon' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $settings = HeaderFooter::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($settings->logo && file_exists(public_path('uploads/settings/'.$settings->logo))) {
                unlink(public_path('uploads/settings/'.$settings->logo));
            }

            $image = $request->file('logo');
            $imageName = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/settings');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $imageName);
            $data['logo'] = $imageName;
        }

        $settings->update($data);

        return redirect()->back()
            ->with('success', 'Settings updated successfully!');
    }

    public function destroy($id)
    {
        $settings = HeaderFooter::findOrFail($id);
        if ($settings->logo && file_exists(public_path('uploads/settings/'.$settings->logo))) {
            unlink(public_path('uploads/settings/'.$settings->logo));
        }

        $settings->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings deleted successfully!');
    }

    public function edit($id)
    {
        $settings = HeaderFooter::findOrFail($id);

        return view('admin.settings.edit', compact('settings'));
    }
}
