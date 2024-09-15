<?php

namespace App\Domain\Entities\Checkout;

use App\Domain\Entities\Product;

class CheckoutItem
{
    public Product $product;
    public int $quantity;
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
    public function getTotalPrice(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }
}
