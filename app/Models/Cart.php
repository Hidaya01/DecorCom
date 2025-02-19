<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['name','user_id', 'decor_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function decor()
    {
        return $this->belongsTo(Decor::class);
    }
}
