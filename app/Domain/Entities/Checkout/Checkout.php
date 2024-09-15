<?php

namespace App\Domain\Entities\Checkout;

class Checkout
{
    private array $items;
    public function addItemToCheckout(CheckoutItem $item): void
    {
        array_push($this->items, $item);
    }
    public function getItems()
    {
        return $this->items;
    }
    public function getTotalPrice(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total +=  $item->getTotalPrice();
        }
        return $total;
    }
}
