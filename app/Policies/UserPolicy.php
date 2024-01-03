<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function owner(User $authenticated, User $owner){
        return $authenticated->id == $owner->id;
    }

    public function isAdmin(User $user){
        return $user->hasRole('Admin');
    }

    public function ownerOrAdmin(User $authenticated, User $owner){
        return $authenticated->id == $owner->id || $authenticated->hasRole('Admin');
    }
}
