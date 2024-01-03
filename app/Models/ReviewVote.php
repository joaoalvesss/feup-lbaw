<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewVote extends Pivot  {
    use HasFactory;
    protected $table = 'review_vote';

    public $timestamps = false;

    protected $fillable = ['vote'];
}