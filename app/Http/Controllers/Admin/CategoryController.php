<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.category.create');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:categories,category_name',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['category_name']);
        }

        Category::create($data);

        return back()
            ->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();


        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['category_name']);
        }

        $category->update($data);

        return back()
            ->with('success', 'Category updated successfully!');
    }

    public function destroy($id)

    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()
            ->with('success', 'Category deleted successfully!');
    }
}
