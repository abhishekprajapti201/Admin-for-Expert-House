<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $brandings = Brand::latest()->paginate(10);

        return view('admin.branding.index', compact('brandings'));
    }


    public function create()
    {
        return view('admin.branding.create');
    }

    public function edit($id)
    {
        $branding = Brand::findOrFail($id);
        return view('admin.branding.edit', compact('branding'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'nullable|string|max:255',
            'images' => 'required|array',
            'images.*' => 'file',
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('uploads/branding'), $imageName);

                $images[] = 'uploads/branding/' . $imageName;
            }
        }

        Brand::create([
            'author_name' => $request->author_name,
            'images' => json_encode($images),
        ]);

        return back()
            ->with('success', 'Branding created successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $branding = Brand::findOFail($id);
        $images = $branding->images ?? [];

        if ($request->hasFile('images')) {

            foreach ($images as $oldImage) {
                if (file_exists(public_path($oldImage))) {
                    unlink(public_path($oldImage));
                }
            }

            $images = [];

            foreach ($request->file('images') as $image) {

                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('uploads/branding'), $imageName);

                $images[] = 'uploads/branding/' . $imageName;
            }
        }

        $branding->update([
            'author_name' => $request->author_name,
            'images' => $images,
        ]);

        return back()
            ->with('success', 'Branding updated successfully.');
    }
    public function destroy($id)
    {
        $branding = Brand::findOFail($id);

        if ($branding->images) {
            foreach ($branding->images as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        $branding->delete();

        return back()
            ->with('success', 'Branding deleted successfully.');
    }
}
