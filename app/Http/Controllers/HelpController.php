<?php

namespace App\Http\Controllers;

use App\Models\HelpArticle;
use App\Models\HelpCategory;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display the Help Center home page.
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'patient');
        $query = $request->get('q');

        if ($query) {
            $articles = HelpArticle::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->where('is_published', true)
                ->get();

            return view('help.search', compact('articles', 'query'));
        }

        $categories = HelpCategory::where('type', $type)
            ->orWhere('type', 'both')
            ->orderBy('order')
            ->with(['articles' => function ($q) {
                $q->where('is_published', true)->limit(5);
            }])
            ->get();

        return view('help.index', compact('categories', 'type'));
    }

    /**
     * Display a help category and its articles.
     */
    public function category(HelpCategory $category)
    {
        $articles = $category->articles()->where('is_published', true)->paginate(15);

        return view('help.category', compact('category', 'articles'));
    }

    /**
     * Display a specific help article.
     */
    public function article(HelpArticle $article)
    {
        if (! $article->is_published) {
            abort(404);
        }

        $article->increment('views');

        $relatedArticles = HelpArticle::where('help_category_id', $article->help_category_id)
            ->where('id', '!=', $article->id)
            ->where('is_published', true)
            ->limit(5)
            ->get();

        return view('help.article', compact('article', 'relatedArticles'));
    }
}
