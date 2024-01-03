<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    public function admin(User $user){
        return $user->hasRole('Admin');
    }
}
