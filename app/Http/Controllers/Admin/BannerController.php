<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('admin.banner.index', compact('banners'));
    }


    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video_url'     => 'required|url',
            'heading'       => 'required|string|max:255',
            'first_button'  => 'nullable|string|max:255',
            'second_button' => 'nullable|string|max:255',
        ]);

        Banner::create($request->only([
            'video_url',
            'heading',
            'first_button',
            'second_button',
        ]));

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }


    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'video_url'     => 'required|url',
            'heading'       => 'required|string|max:255',
            'first_button'  => 'nullable|string|max:255',
            'second_button' => 'nullable|string|max:255',
        ]);

        $banner->update($request->only([
            'video_url',
            'heading',
            'first_button',
            'second_button',
        ]));

        return
            back()
            ->with('success', 'Banner updated successfully.');
    }


    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
