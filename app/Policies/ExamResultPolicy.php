<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ExamResult;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamResultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Any authenticated user can view their own results
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExamResult $examResult): bool
    {
        // Users can only view their own results
        return $user->id === $examResult->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Allow creating exam results (adjust with roles/permissions as needed)
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExamResult $examResult): bool
    {
        // No one can update exam results through the web interface
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExamResult $examResult): bool
    {
        // No one can delete exam results through the web interface
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ExamResult $examResult): bool
    {
        // No one can restore exam results through the web interface
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ExamResult $examResult): bool
    {
        // No one can force delete exam results through the web interface
        return false;
    }
}
