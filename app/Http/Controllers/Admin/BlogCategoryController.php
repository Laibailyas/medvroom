<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::orderBy('display_order')->get();

        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.blog.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $maxOrder = BlogCategory::max('display_order');
        $order = is_null($maxOrder) ? 0 : $maxOrder + 1;

        BlogCategory::create(array_merge($request->only('name'), ['display_order' => $order]));

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(BlogCategory $category): View
    {
        return view('admin.blog.categories.edit', compact('category'));
    }

    public function update(Request $request, BlogCategory $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name'));

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(BlogCategory $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:blog_categories,id',
        ]);

        foreach ($request->ids as $index => $id) {
            BlogCategory::where('id', $id)->update(['display_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
