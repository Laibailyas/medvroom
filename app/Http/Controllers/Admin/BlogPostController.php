<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::with('category')->latest()->paginate(15);

        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = BlogCategory::orderBy('display_order')->get();

        return view('admin.blog.posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'author_name' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');
        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(BlogPost $post): View
    {
        $categories = BlogCategory::orderBy('display_order')->get();

        return view('admin.blog.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $post): RedirectResponse
    {
        $validated = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'author_name' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');
        if ($validated['is_published'] && ! $post->published_at) {
            $validated['published_at'] = now();
        } elseif (! $validated['is_published']) {
            $validated['published_at'] = null;
        }

        $post->update($validated);

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
