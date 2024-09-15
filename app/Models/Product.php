<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = true;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }
    public function toppings(): BelongsToMany
    {
        return $this->belongsToMany(Topping::class, 'order_product_toppings', 'order_product_id', 'topping_id');
            
    }
}
