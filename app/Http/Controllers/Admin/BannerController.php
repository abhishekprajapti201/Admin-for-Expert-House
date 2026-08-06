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
        return view('admin.banners.index', compact('banners'));
    }


    public function create()
    {
        return view('admin.banners.create');
    }

   public function store(Request $request)
{

    $request->validate([
        'heading'       => 'required|string|max:255',
        'first_button'  => 'nullable|string|max:255',
        'second_button' => 'nullable|string|max:255',
    ]);

    $videofile = null;

    if ($request->hasFile('video_url')) {

        $request->validate([
            'video_url' => 'file|mimes:mp4,mov,avi,webm|max:20480',
        ]);

        $file = $request->file('video_url');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/banner'), $filename);

        $videofile = 'uploads/banner/' . $filename;

    } elseif ($request->filled('video_url')) {

        $request->validate([
            'video_url' => 'url',
        ]);

        $videofile = $request->video_url;
    }

    Banner::create([
        'video_url'      => $videofile,
        'heading'        => $request->heading,
        'first_button'   => $request->first_button,
        'second_button'  => $request->second_button,
    ]);

    return redirect()->route('banner')
        ->with('success', 'Banner created successfully.');
}

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }


   public function update(Request $request,$id)
{
    $request->validate([
        'heading'       => 'required|string|max:255',
        'first_button'  => 'nullable|string|max:255',
        'second_button' => 'nullable|string|max:255',
    ]);
    $banner = Banner::findOrFail($id);
    $videofile = $banner->video_url; // Keep old value by default

    if ($request->hasFile('video_url')) {

        $request->validate([
            'video_url' => 'file|mimes:mp4,mov,avi,webm|max:20480',
        ]);

        // Delete old file if it exists
        if (
            $banner->video_url &&
            file_exists(public_path($banner->video_url)) &&
            !filter_var($banner->video_url, FILTER_VALIDATE_URL)
        ) {
            unlink(public_path($banner->video_url));
        }

        $file = $request->file('video_url');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/banner'), $filename);

        $videofile = 'uploads/banner/' . $filename;

    } elseif ($request->filled('video_url')) {

        $request->validate([
            'video_url' => 'url',
        ]);

        $videofile = $request->video_url;
    }

      $banner->update([
        'video_url'      => $videofile,
        'heading'        => $request->heading,
        'first_button'   => $request->first_button,
        'second_button'  => $request->second_button,
    ]);

    return back()->with('success', 'Banner updated successfully.');
}

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()
            ->route('banner')
            ->with('success', 'Banner deleted successfully.');
    }
}
