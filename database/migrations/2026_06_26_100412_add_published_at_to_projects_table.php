<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->date('published_at')->nullable()->after('date');
        });

        // Migrate existing string dates to published_at
        DB::table('projects')->get()->each(function ($project) {
            DB::table('projects')->where('id', $project->id)->update([
                'published_at' => now(),
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
    }
};
