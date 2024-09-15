<?php

namespace App\Domain\Entities\Order;

use DateTime;
use DateTimeInterface;
use App\Domain\VO\Address;
use App\Domain\Entities\Driver;

final class Delivery
{
    private float $price;
    private Driver $driver;
    private Address $address;
    private DateTimeInterface $deliveryForeCast;
    public function __construct(float $price,  Address $address, DateTimeInterface $deliveryForeCast, private ?string $id = null)
    {
        $this->price = $price;
        $this->address = $address;
        $this->deliveryForeCast = $deliveryForeCast;
        $this->id = $id;
    }
    public function getPrice(): float
    {
        return $this->price;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }
    public function getDeliveryForeCast(): DateTime
    {
        return $this->deliveryForeCast;
    }
}
