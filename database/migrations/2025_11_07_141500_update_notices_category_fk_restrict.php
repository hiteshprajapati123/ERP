<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop existing FK (nullOnDelete) and recreate with RESTRICT
        Schema::table('notices', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('notices', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')->on('notice_categories')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        // Revert back to NULL on delete
        Schema::table('notices', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('notices', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')->on('notice_categories')
                ->nullOnDelete();
        });
    }
};
