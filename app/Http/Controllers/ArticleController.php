<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tab = $request->input('tab', 'jurnal'); // default is 'jurnal'

        if ($tab === 'buku') {
            $booksQuery = Article::published()->whereIn('category', ['Books', 'Buku']);
            if ($search) {
                $booksQuery->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('excerpt', 'like', '%' . $search . '%')
                      ->orWhere('author', 'like', '%' . $search . '%');
                });
            }
            $books = $booksQuery->orderByDesc('is_pinned')->paginate(9)->withQueryString();
            $journals = null;
        } else {
            $journalsQuery = Article::published()->whereNotIn('category', ['Books', 'Buku']);
            if ($search) {
                $journalsQuery->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('excerpt', 'like', '%' . $search . '%')
                      ->orWhere('author', 'like', '%' . $search . '%');
                });
            }
            $journals = $journalsQuery->orderByDesc('is_pinned')->paginate(10)->withQueryString();
            $books = null;
        }

        return view('articles.index', compact('books', 'journals', 'tab'));
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
