<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_notices', function (Blueprint $table) {
            $table->foreignId('notice_category_id')->nullable()->constrained('notice_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_notices', function (Blueprint $table) {
            $table->dropForeign(['notice_category_id']);
            $table->dropColumn('notice_category_id');
        });
    }
};
