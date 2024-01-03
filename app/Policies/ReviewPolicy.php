<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;

class ReviewPolicy
{
    public function delete(User $user, Review $review){
        return $review->user_id == $user->id || $user->hasRole('Admin');
    }

    public function comment(User $user, $hasCommented){
        return $hasCommented || ($user->hasRole('Admin'));
    }
}
