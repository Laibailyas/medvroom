<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpCategory;
use Illuminate\Http\Request;

class HelpCategoryController extends Controller
{
    public function index()
    {
        $categories = HelpCategory::orderBy('order')->get();

        return view('admin.help.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.help.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:patient,provider,both',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        // Get the next order value
        $maxOrder = HelpCategory::max('order');
        $order = is_null($maxOrder) ? 0 : $maxOrder + 1;

        HelpCategory::create(array_merge($request->all(), ['order' => $order]));

        return redirect()->route('admin.help.categories.index')
            ->with('success', 'Category created successfully');
    }

    public function edit(HelpCategory $category)
    {
        return view('admin.help.categories.edit', compact('category'));
    }

    public function update(Request $request, HelpCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:patient,provider,both',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.help.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:help_categories,id',
        ]);

        foreach ($request->ids as $index => $id) {
            HelpCategory::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(HelpCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.help.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
