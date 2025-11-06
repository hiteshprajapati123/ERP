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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            
            // Student Details
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('roll_number');
            
            // Address
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            
            // Registration Details
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
            
            // Add index for better performance on common queries
            $table->index('email');
            $table->index('phone');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
