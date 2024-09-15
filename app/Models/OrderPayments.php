<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderPayments extends Model
{
    use HasFactory;
    protected $table = 'order_payments';
    protected $fillable = ['status', 'payment_method_id'];
    public function method(): HasOne
    {
        return $this->hasOne(PaymentMethod::class);
    }
}
