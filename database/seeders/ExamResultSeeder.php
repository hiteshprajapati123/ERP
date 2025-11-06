<?php

namespace Database\Seeders;

use App\Models\ExamResult;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ExamResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::take(5)->get();
        $examNames = ['Mid Term', 'Final Term', 'Quiz 1', 'Quiz 2', 'Assignment'];
        $subjects = ['Mathematics', 'Science', 'English', 'History', 'Computer Science'];
        
        if ($users->isEmpty()) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        foreach ($users as $user) {
            foreach ($examNames as $exam) {
                foreach ($subjects as $subject) {
                    // Randomly select total marks (100, 50, or 20)
                    $totalMarks = [100, 50, 20][array_rand([100, 50, 20])];
                    
                    // Generate obtained marks based on total marks
                    $obtainedMarks = rand(0, $totalMarks);
                    
                    // Calculate percentage and grade
                    $percentage = ($obtainedMarks / $totalMarks) * 100;
                    $grade = ExamResult::calculateGrade($percentage);
                    
                    ExamResult::create([
                        'user_id' => $user->id,
                        'exam_name' => "$exam - $subject",
                        'date' => Carbon::now()->subDays(rand(1, 30)),
                        'obtained_marks' => $obtainedMarks,
                        'total_marks' => $totalMarks,
                        'grade' => $grade,
                    ]);
                }
            }
        }
        
        $this->command->info('Exam results seeded successfully!');
    }
}
