<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $projects = $query->with('images')->orderByDesc('is_pinned')->orderBy('published_at', 'desc')->paginate(9);

        return view('projects.index', compact('projects'));
    }

    public function show($projectSlugOrId)
    {
        // 1. Jika parameter berupa angka (ID lama), redirect 301 ke slug baru
        if (is_numeric($projectSlugOrId)) {
            $project = Project::find($projectSlugOrId);
            if ($project && $project->slug) {
                return redirect()->route('projects.show', $project->slug, 301);
            }
        }

        // 2. Cari project berdasarkan slug
        $project = Project::where('slug', $projectSlugOrId)->firstOrFail();
        $project->load('images');

        $related = Project::with('images')->where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'related'));
    }
}
