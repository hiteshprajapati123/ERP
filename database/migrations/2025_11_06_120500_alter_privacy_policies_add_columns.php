<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('privacy_policies', function (Blueprint $table) {
            // Add explicit section columns (nullable to support existing data)
            $table->text('info_we_collect')->nullable()->after('introduction');
            $table->text('how_we_use')->nullable()->after('info_we_collect');
            $table->text('data_protection')->nullable()->after('how_we_use');
            $table->text('your_rights')->nullable()->after('data_protection');
            $table->text('updates_to_policy')->nullable()->after('your_rights');

            // Prefer date for last_updated while keeping backward compatibility
            $table->date('last_updated_date')->nullable()->after('last_updated');
        });
    }

    public function down(): void
    {
        Schema::table('privacy_policies', function (Blueprint $table) {
            $table->dropColumn([
                'info_we_collect',
                'how_we_use',
                'data_protection',
                'your_rights',
                'updates_to_policy',
                'last_updated_date',
            ]);
        });
    }
};
