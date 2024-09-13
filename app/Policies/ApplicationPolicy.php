<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // return $user === Auth::user() && $user->isEmployer();
    }

    /** 
     * Determine whether the user can view the model.
     */
    public function view(User $user, Application $application): bool
    {
        // return $user === Auth::user() && $user->isEmployer() &&
        //     $user->where('id', $application->user_id) &&
        //     $application->where($application->post->id, $application->post_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Application $application): bool
    {
        if ($user->id === $application->user_id) {
            return true;
        }

        return false; //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Application $application): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Application $application): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Application $application): bool
    {
        //
    }

public function accept(User $user, Application $application)
{
    // Logic to check if the user can accept the application
    return $user->id === $application->user_id; // كمثال، يمكن للمستخدم صاحب التطبيق قبوله
}
}