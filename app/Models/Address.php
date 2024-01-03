<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = ['label', 'street', 'city', 'postal_code', 'user_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function purchases(): HasMany{
        return $this->hasMany(Purchase::class);
    }
 
    
}
