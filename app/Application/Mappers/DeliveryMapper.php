<?php

namespace App\Application\Mappers;

use DateTime;
use App\Facades\DbConfig;
use App\Domain\VO\Address;
use App\Domain\Enums\OrderStatus;
use App\Domain\Entities\Order\Delivery;

class DeliveryMapper
{
    public static function createDelivery(Address $adress_id, ?OrderStatus $status = null): Delivery
    {
        if ($status == OrderStatus::CONFIRMED) {
            $dateTime = new DateTime();
            $dateTime->modify(DbConfig::get('averegae_delivery_time'));
            return new Delivery(DbConfig::get('delivery_fee'), $adress_id, $dateTime);
        }
        return new Delivery(DbConfig::get('delivery_fee'), $adress_id, new DateTime());
    }
}
