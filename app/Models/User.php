<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isArtisan()
    {
        return $this->role === 'artisan';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    // An artisan has one shop
    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    // client can place multiple orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    //artisan receive orders to their shop
    public function receivedOrders()
    {
        return $this->hasManyThrough(Order::class, Shop::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(Decor::class, 'favoris');
    }

    public function panier()
    {
        return $this->belongsToMany(Decor::class, 'panier')->withPivot('quantity');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
