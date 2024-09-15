<?php

namespace App\Application\Mappers\Order;

use App\Domain\Entities\Order\OrderItem;
use App\Application\Services\ToppingsService;
use App\Application\Services\ProductsServices;

class OrderItemsMapper
{
    public static function createOrderItems(array $items, ProductsServices $productService, ToppingsService $toppingService): array
    {
        $orderItems = [];

        foreach ($items as $item) {
            $product = $productService->getProductByIdToEntity($item['product_id']);
            $toppings = [];
            foreach ($item['toppings'] as $topping) {
                $toppings[] = $toppingService->getToppingByIdToEntity($topping);
            }
            $orderItem = new OrderItem($product, $item['quantity']);
            $orderItem->setToppings($toppings);
            $orderItems[] = $orderItem;
        }
        return $orderItems;
    }
}
