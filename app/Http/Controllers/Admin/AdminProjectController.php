<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('images')->orderBy('published_at', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'sdgs' => 'nullable|string|max:255',
            'author' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'published_at' => 'required|date',
        ]);

        $data = $request->except('images');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/projects'), $imageName);
            $data['image'] = 'uploads/projects/' . $imageName;
        }

        $project = Project::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                $name = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/projects'), $name);
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => 'uploads/projects/' . $name,
                    'order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        $project->load('images');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:project_images,id',
            'sdgs' => 'nullable|string|max:255',
            'author' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'published_at' => 'required|date',
        ]);

        $data = $request->except('images');

        if ($request->hasFile('image')) {
            if ($project->image && file_exists(public_path($project->image))) {
                @unlink(public_path($project->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/projects'), $imageName);
            $data['image'] = 'uploads/projects/' . $imageName;
        }

        $project->update($data);

        // Delete selected gallery images
        if ($request->filled('delete_images')) {
            $toDelete = ProjectImage::whereIn('id', $request->delete_images)
                ->where('project_id', $project->id)
                ->get();
            foreach ($toDelete as $pi) {
                if (file_exists(public_path($pi->image))) {
                    @unlink(public_path($pi->image));
                }
                $pi->delete();
            }
        }

        // Upload new gallery images
        if ($request->hasFile('images')) {
            $maxOrder = ProjectImage::where('project_id', $project->id)->max('order') ?? -1;
            foreach ($request->file('images') as $i => $file) {
                $name = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/projects'), $name);
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => 'uploads/projects/' . $name,
                    'order' => $maxOrder + 1 + $i,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->image && file_exists(public_path($project->image))) {
            @unlink(public_path($project->image));
        }

        foreach ($project->images as $pi) {
            if (file_exists(public_path($pi->image))) {
                @unlink(public_path($pi->image));
            }
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
