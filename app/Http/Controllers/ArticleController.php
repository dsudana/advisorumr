<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->input('tag'));
            });
        }

        $articles = $query->paginate(9);

        // Sidebar Data
        $categories = Category::withCount('articles')->get();
        $tags = Tag::all();
        $recentArticles = Article::where('status', 'published')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('articles.index', compact('articles', 'categories', 'tags', 'recentArticles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'tags', 'user'])
            ->firstOrFail();

        // Increment views if you have a view counter (optional, adding for future proofing)
        // $article->increment('views');

        // Sidebar Data
        $categories = Category::withCount('articles')->get();
        $tags = Tag::all();
        $recentArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('articles.show', compact('article', 'categories', 'tags', 'recentArticles'));
    }
}
