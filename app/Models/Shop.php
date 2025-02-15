<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function decors()
    {
        return $this->hasMany(Decor::class);
    }
}
