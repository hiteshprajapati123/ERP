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
        // For MySQL, we need to modify the enum to include 'teacher'
        // First, let's check the current column type and modify it
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user_student', 'teacher') DEFAULT 'user_student'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'teacher' from the enum (revert to original)
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user_student') DEFAULT 'user_student'");
    }
};
