<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderByDesc('is_pinned')->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function togglePin(Article $article)
    {
        $article->update(['is_pinned' => !$article->is_pinned]);
        return back()->with('success', $article->is_pinned ? 'Artikel di-pin.' : 'Artikel di-unpin.');
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'excerpt'     => 'nullable|string|max:500',
            'category'    => 'required|string|max:100',
            'author'      => 'required|string|max:255',
            'status'      => 'required|in:draft,published',
            'tags'        => 'nullable|string|max:255',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'published_at'=> 'nullable|date',
        ]);

        $data = $request->except('thumbnail');
        $data['slug'] = $this->uniqueSlug($request->title);
        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['published_at'] = $request->status === 'published'
            ? ($request->published_at ?? now())
            : null;

        if ($request->hasFile('thumbnail')) {
            $name = time() . '_' . uniqid() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('uploads/articles'), $name);
            $data['thumbnail'] = 'uploads/articles/' . $name;
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Publication added successfully.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'excerpt'     => 'nullable|string|max:500',
            'category'    => 'required|string|max:100',
            'author'      => 'required|string|max:255',
            'status'      => 'required|in:draft,published',
            'tags'        => 'nullable|string|max:255',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'published_at'=> 'nullable|date',
        ]);

        $data = $request->except('thumbnail');
        $data['is_pinned'] = $request->boolean('is_pinned');

        // Re-slug only if title changed
        if ($request->title !== $article->title) {
            $data['slug'] = $this->uniqueSlug($request->title, $article->id);
        }

        $data['published_at'] = $request->status === 'published'
            ? ($request->published_at ?? $article->published_at ?? now())
            : null;

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail && file_exists(public_path($article->thumbnail))) {
                @unlink(public_path($article->thumbnail));
            }
            $name = time() . '_' . uniqid() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('uploads/articles'), $name);
            $data['thumbnail'] = 'uploads/articles/' . $name;
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Publication updated successfully.');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail && file_exists(public_path($article->thumbnail))) {
            @unlink(public_path($article->thumbnail));
        }
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Publication deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
        ]);

        $name = time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/articles'), $name);

        return response()->json(['url' => asset('uploads/articles/' . $name)]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;
        while (
            Article::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }
        return $slug;
    }
}
