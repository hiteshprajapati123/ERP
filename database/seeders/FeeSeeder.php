<?php

namespace Database\Seeders;

use App\Models\Fee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::take(2)->get();
        
        if ($users->isEmpty()) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        $fees = [];
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $currentYear = date('Y');
        $statuses = ['pending', 'paid', 'overdue'];

        foreach ($users as $user) {
            foreach (range(0, 11) as $month) {
                $dueDate = Carbon::create($currentYear, $month + 1, 10);
                $status = $statuses[array_rand($statuses)];
                $paidDate = $status === 'paid' ? $dueDate->copy()->subDays(rand(1, 5)) : null;

                // Determine semester based on month
                $semester = $month < 6 ? 'First' : 'Second';
                $academicYear = $month < 6 ? ($currentYear - 1) . '-' . substr($currentYear, -2) : $currentYear . '-' . substr(($currentYear + 1), -2);
                
                $fees[] = [
                    'user_id' => $user->id,
                    'month_year' => $months[$month] . ' ' . $currentYear,
                    'description' => "$semester Semester Fee - Academic Year $academicYear",
                    'amount' => rand(1000, 5000),
                    'due_date' => $dueDate,
                    'status' => $status,
                    'paid_date' => $paidDate,
                    'transaction_id' => $status === 'paid' ? 'TXN' . strtoupper(uniqid()) : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert all fees at once for better performance
        Fee::insert($fees);
        
        $this->command->info('Fee records created successfully!');
    }
}
