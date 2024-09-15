<?php

namespace App\Application\DTO\Product;

use App\Domain\Entities\Group;
use App\Domain\Entities\Product;

readonly class UpdateProductDTO
{

    public function __construct(
        public readonly string|null $name = null,
        public readonly float|null $price = null,
        public readonly string|null $description = null,
        public readonly string|null $group = null,

    ) {}
    public function toEntity()
    {
        return new Product(
            $this->name,
            $this->price,
            $this->description,
            new Group(id: $this->group),
        );
    }
}
