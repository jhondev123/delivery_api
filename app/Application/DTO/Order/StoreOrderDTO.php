<?php

namespace App\Application\DTO\Order;

use App\Domain\Entities\User;
use App\Domain\Enums\OrderStatus;
use App\Domain\Entities\Order\Delivery;
use App\Domain\Entities\Order\Order;
use App\Domain\Entities\Order\OrderPayment;

class StoreOrderDTO
{

    public function __construct(
        public string $address_id,
        public string $user_id,
        public array $items,
        public string $payment_method

    ) {}
}
