<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total_price'];
    //decor belongs to one artisan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        //decor can be sold to multible clents
    public function decors()
    {
        return $this->belongsToMany(Decor::class, 'order_items')->withPivot('quantity', 'subtotal_price');
    }
}
