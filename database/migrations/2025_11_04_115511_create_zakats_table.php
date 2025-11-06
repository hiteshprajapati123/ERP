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
        Schema::create('zakats', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->text('hero_quote');
            $table->string('hero_image')->nullable();
            $table->string('what_is_title');
            $table->text('what_is_content');
            $table->string('what_is_image')->nullable();
            $table->json('key_points');
            $table->string('donation_title');
            $table->text('donation_description');
            $table->string('qr_code_image')->nullable();
            $table->text('donation_note');
            $table->decimal('nisab_gold', 10, 2)->default(87.48);
            $table->decimal('nisab_silver', 10, 2)->default(612.36);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakats');
    }
};
