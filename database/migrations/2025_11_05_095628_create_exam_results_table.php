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
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('paper_id')->constrained('papers')->onDelete('cascade');
            $table->string('exam_name');
            $table->date('date');
            $table->float('obtained_marks', 8, 2)->comment('Marks obtained by the student');
            $table->float('total_marks', 8, 2)->default(100)->comment('Total marks for the exam (e.g., 100, 50, 20)');
            $table->string('grade', 2);
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index(['user_id', 'date']);
            $table->index('exam_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
