<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpArticle;
use App\Models\HelpCategory;
use Illuminate\Http\Request;

class HelpArticleController extends Controller
{
    public function index()
    {
        $articles = HelpArticle::with('category')->orderBy('order')->get();

        return view('admin.help.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = HelpCategory::all();

        return view('admin.help.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'help_category_id' => 'required|exists:help_categories,id',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        // Get the next order value within the category
        $maxOrder = HelpArticle::where('help_category_id', $request->help_category_id)->max('order');
        $data['order'] = is_null($maxOrder) ? 0 : $maxOrder + 1;

        HelpArticle::create($data);

        return redirect()->route('admin.help.articles.index')
            ->with('success', 'Article created successfully');
    }

    public function edit(HelpArticle $article)
    {
        $categories = HelpCategory::all();

        return view('admin.help.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, HelpArticle $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'help_category_id' => 'required|exists:help_categories,id',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        $article->update($data);

        return redirect()->route('admin.help.articles.index')
            ->with('success', 'Article updated successfully');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:help_articles,id',
        ]);

        foreach ($request->ids as $index => $id) {
            HelpArticle::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(HelpArticle $article)
    {
        $article->delete();

        return redirect()->route('admin.help.articles.index')
            ->with('success', 'Article deleted successfully');
    }
}
