<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InsightPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InsightPageController extends Controller
{
  public function index()
    {
        $posts = InsightPages::with(['category'])->latest()->get();
        return view('admin.insights.listing',compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.insights.create',compact('categories'));
    }


     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required|string|max:255',
            'paragraph' => 'nullable|string',
            'image' => 'nullable|file',
            'description' => 'nullable|string',
            'created_by' => 'nullable|string|max:100',
            'note' => 'nullable|string',
            'date' => 'nullable|date',
            'cat_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/posts');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }


            $image->move($destinationPath, $imageName);
            $data['image'] = 'uploads/posts/'.$imageName;
        }

        InsightPages::create($data);

        return back()
            ->with('success', 'Post created successfully!');
    }


    public function edit($id)
{
    $post = InsightPages::with('category')->findOrFail($id);
    $categories = Category::all();

    return view('admin.insights.edit', compact('post', 'categories'));
}

    public function update(Request $request, $id)

    {

    $post = InsightPages::findOrFail($id);

    $validator = Validator::make($request->all(), [
            'heading' => 'required|string|max:255',
            'paragraph' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'nullable|string',
            'created_by' => 'nullable|string|max:100',
            'note' => 'nullable|string',
            'date' => 'nullable|date',
            'cat_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path('uploads/posts/' . $post->image))) {
                unlink(public_path('uploads/posts/' . $post->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/posts');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $imageName);
            $data['image'] = 'uploads/posts/'.$imageName;
        }

        $post->update($data);

        return back()
            ->with('success', 'Post updated successfully!');
    }

      public function destroy($id)
    {
        $post = InsightPages::findOrFail($id);
        if ($post->image && file_exists(public_path('uploads/posts/' . $post->image))) {
            unlink(public_path('uploads/posts/' . $post->image));
        }

        $post->delete();

        return back()
            ->with('success', 'Post deleted successfully!');
    }
}
