<?php

namespace App\Domain\Enums;

enum OrderStatus: string
{
    case AWAITING_PAYMENT = 'awaiting_payment';
    case PENDING = 'pending';
    case REFUSED = 'refused';
    case CONFIRMED = 'confirmed';
    case INDELIVERY = 'in_delivery';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
    public function getValue(): string
    {
        return $this->value;
    }
}
