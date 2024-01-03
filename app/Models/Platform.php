<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Platform extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }
}
