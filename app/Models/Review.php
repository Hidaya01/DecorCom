<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['content', 'rating', 'user_id', 'decor_id'];

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function decor()
    {
        return $this->belongsTo(Decor::class);
    }
}
