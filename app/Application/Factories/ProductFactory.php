<?php

namespace App\Application\Factories;

use App\Domain\Entities\Group;
use App\Domain\Entities\Product;
use App\Application\DTO\Product\StoreProductDTO;
use App\Application\DTO\Product\UpdateProductDTO;

final class ProductFactory
{
    public function createProductFromDtoToUpdate(UpdateProductDTO $dto, Product $existingProduct): Product
    {
        $product = new Product();
        $product->setId($dto->id);
        $product->setName($dto->name ?? $existingProduct->getName());
        $product->setDescription($dto->description ?? $existingProduct->getDescription());
        $product->setPrice($dto->price ?? $existingProduct->getPrice());
        $groupId = $dto->group ?? $existingProduct->getGroup()->getId();
        $product->setGroup(new Group($groupId));

        return $product;
    }
    public function createProductFromDtoToStore(StoreProductDTO $dto): Product
    {
        $product = new Product(
            name: $dto->name,
            price: $dto->price,
            description: $dto->description,
        );
        $groupId = $dto->group ?? null;
        if ($groupId) {
            $product->setGroup(new Group(id: $groupId));
        }
        return $product;
    }
}
