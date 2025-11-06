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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->default('About Us');
            $table->text('intro_content');
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('history_content');
            $table->json('what_we_offer')->nullable();
            $table->json('highlights')->nullable();
            $table->json('programs')->nullable();
            $table->text('principal_message')->nullable();
            $table->string('principal_name')->nullable();
            $table->string('principal_title')->nullable();
            $table->string('contact_address');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('banner_image')->nullable();
            $table->string('principal_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
