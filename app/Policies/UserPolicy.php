<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    public function edit(User $user , User $currentUser)
    {
        return $user->id == $currentUser->id;
    }
}
