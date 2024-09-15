<?php

namespace App\Application\DTO\Product;

use App\Domain\Entities\Group;
use App\Domain\Entities\Product;

final class StoreProductDTO
{

    public function __construct(
        public readonly string $name,
        public readonly float $price,
        public readonly string $description,
        public readonly string $group,
    ) {}
    public function toEntity(): Product
    {
        return new Product(
            name: $this->name,
            price: $this->price,
            description: $this->description,
            group: new Group(id: $this->group)
        );
    }
}
