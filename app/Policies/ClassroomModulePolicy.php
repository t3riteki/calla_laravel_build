<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\ClassroomModule;
use App\Models\EnrolledUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassroomModulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(EnrolledUser $enrolledUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(EnrolledUser $enrolledUser, ClassroomModule $classroomModule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(EnrolledUser $enrolledUser, Classroom $classroom,): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ClassroomModule $classroomModule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ClassroomModule $classroomModule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ClassroomModule $classroomModule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ClassroomModule $classroomModule): bool
    {
        return false;
    }

    private function checkOwner(EnrolledUser $enrolledUser, ClassroomModule $classroomModule){
        return $enrolledUser->user === $classroomModule->EnrolledUser->user;
    }
    private function checkEnrolled(EnrolledUser $enrolledUser, Classroom $classroom ){
        return $classroom->EnrolledUser->has($enrolledUser);
    }
    private function checkRole(){}

}
