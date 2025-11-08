<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('roll_number', 50)->unique()->nullable()->after('phone');
        });

        // Optionally seed roll numbers for existing default users if present
        DB::table('users')->where('email', 'hitesh@example.com')->update(['roll_number' => 'RN0001']);
        DB::table('users')->where('email', 'admin@example.com')->update(['roll_number' => 'RNADMIN']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roll_number');
        });
    }
};
