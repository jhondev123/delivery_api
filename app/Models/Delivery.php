<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'delivery_forecast',
        'address_id',
        'price'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
