<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Services\ProductsServices;
use App\Application\DTO\Product\StoreProductDTO;
use App\Application\DTO\Product\UpdateProductDTO;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductsController extends Controller
{
    public function __construct(private ProductsServices $productService) {}
    public function index()
    {
        $products = $this->productService->getAllProductsWithGroup();
        return response()->json($products);
    }


    public function store(StoreProductRequest $request)
    {
        $productStoreDto = new StoreProductDTO(
            $request->input('name'),
            $request->input('price'),
            $request->input('description'),
            $request->input('group')
        );
        try {

            return response()->json([
                'message' => 'Product created successfully',
                'data' => $this->productService->store($productStoreDto),
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $productUpdateDto = new UpdateProductDTO(
            $request->input('name'),
            $request->input('price'),
            $request->input('description'),
            $request->input('group')
        );
        $productData = $this->productService->update($productUpdateDto, $id);
        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $productData,
        ], 200);
    }

    public function destroy(string $id)
    {
        $deleted = $this->productService->destroy($id);

        if (!$deleted) {
            return response()->json(['error' => 'Could not delete product'], 500);
        }
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
    public function search(Request $request)
    {
        $products = $this->productService->search($request);
        return response()->json($products);
    }
}
