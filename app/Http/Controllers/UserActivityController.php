<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserActivityController extends Controller
{
    /**
     * Get recent activities for the authenticated user
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);
        
        // Get all activities for the authenticated user with pagination
        $query = UserActivity::where('user_id', auth()->id())
            ->with(['user', 'model'])
            ->latest();
            
        $activities = $query->paginate($perPage, ['*'], 'page', $page);
        
        $formattedActivities = $activities->map(function($activity) {
            $activityData = [
                'id' => $activity->id,
                'time' => $activity->created_at->diffForHumans(),
                'date' => $activity->created_at->format('M d, Y h:i A'),
                'progress' => 100,
                'model_type' => $activity->model_type,
                'model_id' => $activity->model_id,
                'activity_type' => $activity->activity_type,
                'icon' => 'info-circle', // Default icon
                'status' => [
                    'class' => 'info',
                    'text' => 'Info'
                ]
            ];

            // Handle user profile updates
            if ($activity->model_type === UserActivity::MODEL_PROFILE || $activity->model_type === 'App\\Models\\User') {
                $activityData['type'] = 'Profile Update';
                $activityData['icon'] = 'user-edit';
                $activityData['title'] = $activity->description ?: 'Profile updated';
                $activityData['description'] = '';
                $activityData['status'] = [
                    'class' => 'info',
                    'text' => 'Updated'
                ];
            }
            // Handle fee activities
            elseif ($activity->model_type === UserActivity::MODEL_FEE || $activity->model_type === 'App\\Models\\Fee') {
                try {
                    $fee = $activity->model;
                    $amount = $fee ? number_format($fee->amount, 2) : 'N/A';
                    $status = $fee ? ($fee->status ?? 'pending') : 'unknown';
                    
                    $activityData['type'] = 'Fee';
                    $activityData['icon'] = 'money-bill-wave';
                    $activityData['title'] = 'Fee ' . ucfirst($activity->activity_type);
                    $activityData['description'] = "Amount: {$amount} - " . ucfirst($status);
                    $activityData['status'] = [
                        'class' => $status === 'paid' ? 'success' : 
                                 ($status === 'overdue' ? 'danger' : 'warning'),
                        'text' => ucfirst($status)
                    ];
                    
                    // Add additional fee data if available
                    if ($fee) {
                        $activityData['fee_data'] = [
                            'amount' => $fee->amount,
                            'status' => $status,
                            'due_date' => $fee->due_date ? $fee->due_date->format('Y-m-d') : null,
                            'paid_date' => $fee->paid_date ? $fee->paid_date->format('Y-m-d') : null,
                            'description' => $fee->description,
                            'created_at' => $activity->created_at->format('Y-m-d H:i:s')
                        ];
                    }
                } catch (\Exception $e) {
                    \Log::error('Error processing fee activity', [
                        'activity_id' => $activity->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    
                    $activityData['type'] = 'Fee';
                    $activityData['icon'] = 'money-bill-wave';
                    $activityData['title'] = 'Fee Activity';
                    $activityData['description'] = 'Fee information not available';
                    $activityData['status'] = [
                        'class' => 'warning',
                        'text' => 'Error'
                    ];
                }
            }
            // Default for other activity types
            else {
                $activityData['type'] = 'System';
                $activityData['icon'] = 'info-circle';
                $activityData['title'] = $activity->description ?: 'Activity recorded';
                $activityData['description'] = '';
                $activityData['status'] = [
                    'class' => 'primary',
                    'text' => 'Processed'
                ];
            }

            return $activityData;
        });

        return response()->json([
            'activities' => $formattedActivities->toArray(),
            'pagination' => [
                'current_page' => $activities->currentPage(),
                'per_page' => $activities->perPage(),
                'total' => $activities->total(),
                'last_page' => $activities->lastPage(),
                'has_more' => $activities->hasMorePages(),
            ]
        ]);
    }

    /**
     * Get activity type display text
     */
    protected function getActivityType($type)
    {
        $types = [
            UserActivity::TYPE_CREATED => 'Created',
            UserActivity::TYPE_UPDATED => 'Updated',
            UserActivity::TYPE_DELETED => 'Deleted',
            UserActivity::TYPE_VIEWED => 'Viewed',
            UserActivity::TYPE_LOGGED_IN => 'Login',
            UserActivity::TYPE_LOGGED_OUT => 'Logout',
            UserActivity::TYPE_PAID => 'Payment',
            UserActivity::TYPE_DOWNLOADED => 'Downloaded',
        ];

        return $types[$type] ?? ucfirst($type);
    }

    /**
     * Get activity icon
     */
    protected function getActivityIcon($type)
    {
        $icons = [
            UserActivity::TYPE_CREATED => 'plus-circle',
            UserActivity::TYPE_UPDATED => 'edit',
            UserActivity::TYPE_DELETED => 'trash',
            UserActivity::TYPE_VIEWED => 'eye',
            UserActivity::TYPE_LOGGED_IN => 'sign-in-alt',
            UserActivity::TYPE_LOGGED_OUT => 'sign-out-alt',
            UserActivity::TYPE_PAID => 'credit-card',
            UserActivity::TYPE_DOWNLOADED => 'download',
        ];

        return $icons[$type] ?? 'info-circle';
    }

    /**
     * Get activity status
     */
    protected function getActivityStatus($type)
    {
        $statuses = [
            UserActivity::TYPE_CREATED => ['text' => 'Completed', 'class' => 'success'],
            UserActivity::TYPE_UPDATED => ['text' => 'Updated', 'class' => 'info'],
            UserActivity::TYPE_DELETED => ['text' => 'Removed', 'class' => 'danger'],
            UserActivity::TYPE_VIEWED => ['text' => 'Viewed', 'class' => 'primary'],
            UserActivity::TYPE_LOGGED_IN => ['text' => 'Success', 'class' => 'success'],
            UserActivity::TYPE_LOGGED_OUT => ['text' => 'Logged Out', 'class' => 'secondary'],
            UserActivity::TYPE_PAID => ['text' => 'Paid', 'class' => 'success'],
            UserActivity::TYPE_DOWNLOADED => ['text' => 'Downloaded', 'class' => 'success'],
        ];

        return $statuses[$type] ?? ['text' => 'Processed', 'class' => 'primary'];
    }

    /**
     * Generate activity title based on type and model
     */
    protected function getActivityTitle($activityType, $modelType, $description = null)
    {
        if ($description) {
            return $description;
        }

        $modelName = class_basename($modelType);
        $action = $this->getActivityType($activityType);

        return "{$action} {$modelName}";
    }

    /**
     * Get progress percentage for progress bar
     */
    protected function getActivityProgress($type)
    {
        // Default progress for different activity types
        $progress = [
            UserActivity::TYPE_CREATED => 100,
            UserActivity::TYPE_UPDATED => 75,
            UserActivity::TYPE_VIEWED => 50,
            UserActivity::TYPE_LOGGED_IN => 100,
            UserActivity::TYPE_LOGGED_OUT => 100,
            UserActivity::TYPE_PAID => 100,
            UserActivity::TYPE_DOWNLOADED => 100,
        ];

        return $progress[$type] ?? 0;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
