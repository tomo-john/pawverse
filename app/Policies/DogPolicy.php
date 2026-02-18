<?php

namespace App\Policies;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Dog Show
     */
    public function view(User $user, Dog $dog): bool
    {
        return $dog->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Dog Update
     */
    public function update(User $user, Dog $dog): bool
    {
        return $dog->user_id === $user->id;
    }

    /**
     * Dog Delete
     */
    public function delete(User $user, Dog $dog): bool
    {
        return $dog->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Dog $dog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Dog $dog): bool
    {
        return false;
    }
}
