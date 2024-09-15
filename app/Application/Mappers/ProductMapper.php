<?php

namespace App\Application\Mappers;

use App\Domain\Entities\Group;
use App\Domain\Entities\Product;
use App\Application\DTO\Product\ProductDTO;

class ProductMapper
{
    public static function toDTO(Product $product): ProductDTO
    {
        return new ProductDTO(
            id: $product->getId(),
            name: $product->getName(),
            price: $product->getPrice(),
            description: $product->getDescription(),
            group: $product->getGroup() ? [
                'id' => $product->getGroup()->getId(),
                'name' => $product->getGroup()->getName() ?? null,
            ] : null
        );
    }
    public static function toDTOForUpdate(Product $product): ProductDTO
    {
        return new ProductDTO(
            id: $product->getId(),
            name: $product->getName(),
            price: $product->getPrice(),
            description: $product->getDescription(),
            group: $product->getGroup() ? [
                'id' => $product->getGroup()->getId(),
            ] : null
        );
    }
    public static function toDTOForStore(Product $product): ProductDTO
    {
        return new ProductDTO(
            id: null,
            name: $product->getName(),
            price: $product->getPrice(),
            description: $product->getDescription(),
            group: $product->getGroup() ? [
                'id' => $product->getGroup()->getId(),
            ] : null
        );
    }
    public static function toDomain(array $data): Product
    {
        return new Product(
            $data['id'],
            $data['name'],
            $data['price'],
            $data['description'],
            new Group($data['group_id'], $data['group_name'])
        );
    }
}
