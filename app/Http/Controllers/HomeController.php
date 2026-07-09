<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Staff;
use App\Models\HeroPhoto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 5 proyek terbaru untuk halaman depan
        $latestProjects = Project::with('images')->latest()->take(6)->get();
        
        // Ambil statistik
        $stats = [
            'projects' => Project::count(),
            'years' => 17,
            'staff' => Staff::count(),
        ];

        $heroPhotos = HeroPhoto::active()->get();
        $partners = Partner::all();
        $latestArticles = Article::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('welcome', compact('latestProjects', 'stats', 'heroPhotos', 'partners', 'latestArticles'));
    }
}
