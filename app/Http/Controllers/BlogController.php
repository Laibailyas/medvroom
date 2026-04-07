<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::withCount(['posts' => fn ($q) => $q->where('is_published', true)])
            ->orderBy('display_order')
            ->get();

        $featuredPost = BlogPost::with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->first();

        $recentPosts = BlogPost::with('category')
            ->where('is_published', true)
            ->when($featuredPost, fn ($q) => $q->where('id', '!=', $featuredPost->id))
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('blog.index', compact('categories', 'featuredPost', 'recentPosts'));
    }

    public function show(BlogPost $post): View
    {
        abort_unless($post->is_published, 404);

        $post->increment('views');

        $relatedPosts = BlogPost::with('category')
            ->where('is_published', true)
            ->where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
