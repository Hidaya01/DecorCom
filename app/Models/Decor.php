<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decor extends Model
{
    use HasFactory;
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(User::class, 'favoris');
    }

    public function panier()
    {
        return $this->belongsToMany(User::class, 'panier');
    }
}
