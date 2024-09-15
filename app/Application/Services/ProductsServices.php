<?php

namespace App\Application\Services;

use Exception;
use Illuminate\Http\Request;
use App\Domain\Entities\Group;
use App\Domain\Entities\Product;
use App\Models\Product as ProductModel;
use Illuminate\Database\Eloquent\Collection;
use App\Application\Factories\ProductFactory;
use App\Infra\Repositories\ProductRepository;
use App\Application\DTO\Product\StoreProductDTO;
use App\Application\DTO\Product\UpdateProductDTO;
use App\Application\Services\GroupsServices;

final class ProductsServices
{
    public function __construct(private ProductRepository $repository, private ProductFactory $factory) {}
    public function getAllProductsWithGroup(): Collection
    {
        return $this->repository->getAllProductsWithGroups();
    }
    public function getProductById(string $id): ProductModel
    {
        return $this->repository->getProductById($id);
    }
    public function getProductByIdToEntity(string $id): Product
    {
        $product = $this->getProductById($id);
        return new Product(
            $product->name,
            $product->description,
            $product->price,
            new Group($product->group_name, $product->group_id),
            $product->id
        );
    }
    public function store(StoreProductDTO $dto)
    {
        $product = $dto->toEntity();
        return $this->repository->store($product);
    }
    public function update(UpdateProductDTO $dto, string $id)
    {
        $product = $dto->toEntity();
        return  $this->repository->update($product, $id);
    }
    public function destroy(string $id): bool
    {
        return $this->repository->destroy($id);
    }
    public function search(Request $request) {}
}
