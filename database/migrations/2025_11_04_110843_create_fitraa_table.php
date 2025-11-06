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
        Schema::create('fitraa', function (Blueprint $table) {
            $table->id();
            // Hero Section
            $table->string('hero_title')->nullable();
            $table->text('hero_quote')->nullable();
            $table->string('hero_image')->nullable();
            
            // What is Fitraa Section
            $table->string('what_is_title')->nullable();
            $table->text('what_is_content')->nullable();
            $table->string('what_is_image')->nullable();
            
            // Benefits Section
            $table->json('benefits')->nullable(); // Store as JSON array
            
            // Donation Section
            $table->string('donation_title')->nullable();
            $table->text('donation_description')->nullable();
            $table->string('qr_code_image')->nullable();
            $table->text('donation_note')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitraa');
    }
};
