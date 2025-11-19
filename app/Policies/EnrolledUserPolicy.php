<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\EnrolledUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EnrolledUserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EnrolledUser $enrolledUser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role,['instructor','student'],true);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EnrolledUser $enrolledUser): bool
    {
        return ($user->id === $enrolledUser->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EnrolledUser $enrolledUser): bool
    {
        $classroom = $enrolledUser->classroom;
        return ($user->id === $enrolledUser->user_id || $classroom->owner_id === $user->id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EnrolledUser $enrolledUser): bool
    {
        return ($user->id === $enrolledUser->user_id);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EnrolledUser $enrolledUser): bool
    {
        return ($user->id === $enrolledUser->user_id);
    }
}
