<?php

namespace App\Policies;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DogPolicy
{
    /**
     * 一覧表示
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * 詳細ページ
     */
    public function view(?User $user, Dog $dog): bool
    {
        // 自分の犬ならOK
        if ($user && $user->id === $dog->user_id) {
            return true;
        }

        // 他人の犬でも「公開」ならOK
        return $dog->is_public;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * 更新できるか？
     */
    public function update(User $user, Dog $dog): bool
    {
        return $user->id === $dog->user_id;
    }

    /**
     * 削除できるか？
     */
    public function delete(User $user, Dog $dog): bool
    {
        return $user->id === $dog->user_id;
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
