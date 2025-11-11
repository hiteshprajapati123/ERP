<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration creates the 'attendances' table to track user attendance records and holidays.
     * It stores attendance status (present, late, absent, leave) or NULL for holidays for each user per day.
     * The table includes a composite unique constraint to prevent duplicate entries
     * for the same user on the same date.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'holiday'])->nullable()->comment('NULL means holiday, other values represent attendance status');
            $table->text('notes')->nullable()->comment('Additional notes, reason for leave, or holiday description');
            $table->timestamps();
            
            // Add composite unique index to prevent duplicate entries
            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};