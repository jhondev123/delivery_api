<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_products';
    public function toppings(): BelongsToMany
    {
        return $this->belongsToMany(Topping::class, 'order_product_toppings', 'order_product_id', 'topping_id');
    }
}
