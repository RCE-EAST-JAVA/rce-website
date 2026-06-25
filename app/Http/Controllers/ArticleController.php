<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->paginate(9)->withQueryString();
        $categories = Article::where('status', 'published')->distinct()->pluck('category')->sort()->values();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show(Article $article)
    {
        abort_if($article->status !== 'published', 404);

        $related = Article::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'related'));
    }
}
