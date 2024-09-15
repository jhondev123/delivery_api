<?php

namespace App\Application\DTO\Product;

final class ProductDTO implements \JsonSerializable
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?string $name,
        public readonly ?float $price,
        public readonly ?string $description,
        public readonly ?array $group
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'group' => $this->group,
        ];
    }
}
