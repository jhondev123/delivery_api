<?php

namespace App\Application\Services;

use App\Application\DTO\Delivery\StoreDeliveryDTO;
use App\Application\DTO\Delivery\UpdateDeliveryDTO;

class DeliveryService
{
    public function getAllDeliveries() {}
    public function getDeliveryById(string $id) {}
    public function store(StoreDeliveryDTO $dto) {}
    public function update(UpdateDeliveryDTO $dto, string $id) {}
    public function delete(string $id) {}
}
