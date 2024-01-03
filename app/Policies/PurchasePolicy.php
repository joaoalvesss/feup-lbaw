<?php

namespace App\Policies;

use App\Models\User;

class PurchasePolicy
{
    public function admin(User $user){
        return $user->hasRole('Admin');
    }
}
