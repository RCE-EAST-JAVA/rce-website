<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('permissions')->nullable()->after('role');
            $table->boolean('sync_bimbingan')->default(true)->after('permissions');
        });

        // Grant full permissions to existing admin users
        $adminPermissions = [
            'projects' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true],
            'articles' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true],
            'staff' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true],
            'partners' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true],
            'hero' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true],
            'users' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true],
            'bimbingan' => ['view' => true],
        ];

        DB::table('users')->where('role', 'admin')->update([
            'permissions' => json_encode($adminPermissions)
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['permissions', 'sync_bimbingan']);
        });
    }
};
