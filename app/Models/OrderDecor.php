<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDecor extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'decor_id', 'quantity', 'subtotal_price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function decor()
    {
        return $this->belongsTo(Decor::class);
    }
}

