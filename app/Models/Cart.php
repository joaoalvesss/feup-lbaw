<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Pivot{
    use HasFactory;
    protected $table = 'cart';

    public $timestamps = false;

    protected $fillable = ['quantity'];
}