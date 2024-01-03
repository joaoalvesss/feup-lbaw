<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock', 'price', 'score', 'description', 'publication_date'];

    protected $searchable = ['name', 'description'];

    public function platform(): BelongsTo{
        return $this->belongsTo(Platform::class);
    }

    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class);
    }

    public function reviews(): HasMany{
        return $this->hasMany(Review::class);
    }

    public function carts(): BelongsToMany{
        return $this->belongsToMany(User::class, 'cart')->using(Cart::class)->withPivot('quantity');
    }
    
    public function wishlist(): BelongsToMany{
        return $this->belongsToMany(User::class, 'wishlist');
    }

    public function purchases(): HasMany{
        return $this->hasMany(Product::class);
    }

    public function scopeSearch($query, $terms){
        return $query->whereRaw("tsvectors @@ plainto_tsquery('english', ?)", [$terms]);
    }

    public function scopeFilter($query, $filters){
        if($filters['category'] ?? false){
            $query->whereHas('categories', function($query){
                $query->where('name', 'ilike', '%' . request('category') . '%');
            });
        }
    }
}
