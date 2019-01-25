<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 个人信息编辑策略，只有自己才能修改自己的个人信息
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
