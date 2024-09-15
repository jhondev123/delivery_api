<?php

namespace App\Infra\Repositories;

use App\Domain\Entities\Group;
use App\Domain\Entities\Product;
use App\Models\Product as ProductModel;
use App\Http\Filters\SearchProductFilter;
use App\Application\Mappers\ProductMapper;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{

    public function getAllProductsWithGroups(): Collection
    {
        return ProductModel::with('group')->get();
    }
    public function getAllProducts()
    {
        return ProductModel::all();
    }
    public function getProductById($id): ProductModel
    {
        return ProductModel::find($id)
            ->with('group')
            ->firstOrFail();
    }
    public function store(Product $product)
    {
        $productModel = new ProductModel();
        $productModel->name = $product->getName();
        $productModel->price = $product->getPrice();
        $productModel->description = $product->getDescription();
        $productModel->group_id = $product->getGroup()->getId();
        $productModel->save();
        return $productModel;
    }
    public function update(Product $product, string $id)
    {
        $productModel = new ProductModel();
        $productModel = ProductModel::findOrFail($id);
        $productModel->name = $product->getName();
        $productModel->price = $product->getPrice();
        $productModel->description = $product->getDescription();
        $productModel->group_id = $product->getGroup()->getId();
        $productModel->save();
        return $productModel;
    }
    public function destroy(string $id): bool
    {
        $productModel = ProductModel::findOrFail($id);
        if ($productModel) {
            return $productModel->delete();
        }
        return false;
    }
    public function search(SearchProductFilter $filter): array
    {
        $query = ProductModel::join('groups', 'products.group_id', '=', 'groups.id')
            ->select('products.*', 'groups.name as group_name');

        if ($filter->getSearchByName()) {
            $query->where('products.name', 'LIKE', "%{$filter->getSearchByName()}%");
        }
        if ($filter->getSearchByDescription()) {
            $query->where('products.description', 'LIKE', "%{$filter->getSearchByDescription()}%");
        }
        if ($filter->getSearchByGroup()) {
            $query->where('products.group_id', $filter->getSearchByGroup());
        }

        return $query->get()->toArray();
    }
}
