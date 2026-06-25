<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Staff;
use App\Models\HeroPhoto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 aktivitas/proyek terbaru untuk halaman depan
        $latestProjects = Project::latest()->take(3)->get();
        
        // Ambil statistik
        $stats = [
            'projects' => Project::count() + 15, // base stats + dummy
            'years' => 17, // since 2009
            'staff' => Staff::count() + 85, // base stats + dummy
        ];

        $heroPhotos = HeroPhoto::active()->get();

        return view('welcome', compact('latestProjects', 'stats', 'heroPhotos'));
    }
}
