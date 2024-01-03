<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model {
  public $timestamps = false;
  protected $table = 'wishlist';
  
  protected $fillable = ['product_id'];  
}