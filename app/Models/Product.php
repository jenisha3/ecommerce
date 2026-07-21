<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'category_id',
    'name',
    'slug',
    'description',
    'price',
    'discount_price',
    'stock',
    'image',
    'featured',
    'status',
];
    public function category()
{
    return $this->belongsTo(Category::class);
}
    public function carts()
{
    return $this->hasMany(Cart::class);
}
    public function reviews()
{
    return $this->hasMany(Review::class);
}
public function averageRating()
{
    return round($this->reviews()->avg('rating'), 1);
}

public function totalReviews()
{
    return $this->reviews()->count();
}
public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}
}