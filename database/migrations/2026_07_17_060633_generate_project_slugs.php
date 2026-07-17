<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $projects = \App\Models\Project::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($projects as $project) {
            $slug = \Illuminate\Support\Str::slug($project->title);
            $original = $slug;
            $i = 1;
            while (\App\Models\Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $original . '-' . $i++;
            }
            $project->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
