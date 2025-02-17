<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock_quantity', 'image', 'shop_id'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(User::class, 'favoris');
    }

    public function carts()
    {
        return $this->belongsToMany(User::class, 'carts')->withPivot('quantity');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')->withPivot('quantity', 'subtotal_price');
    }
}
