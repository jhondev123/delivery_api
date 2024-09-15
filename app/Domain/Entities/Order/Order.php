<?php

namespace App\Domain\Entities\Order;

use DomainException;
use App\Domain\Entities\User;
use App\Domain\Enums\OrderStatus;
use App\Domain\Enums\PaymentStatus;
use App\Domain\Exceptions\OrderStatusException;


final class Order
{

    private array $orderItems;
    private OrderPayment $payment;
    private User $customer;
    private Delivery $delivery;
    private OrderStatus $status;
    private float $total;

    public function __construct(
        array $orderItems,
        OrderPayment $payment,
        User $customer,
        Delivery $delivery,
        OrderStatus $status,
        private ?string $id = null
    ) {
        $this->validateOrderItems($orderItems);
        $this->orderItems = $orderItems;
        $this->payment = $payment;
        $this->customer = $customer;
        $this->delivery = $delivery;
        $this->status = $status;
        $this->total = $this->calculateTotal();
        $this->id = $id;
    }
    private function calculateTotal(): float
    {
        $total = array_reduce($this->orderItems, function ($sum, OrderItem $item) {
            return $sum + $item->calculateTotalPriceItem();
        }, 0);

        return $total + $this->delivery->getPrice();
    }
    private function validateOrderItems(array $orderItems): void
    {
        if (empty($orderItems)) {
            throw new DomainException('Order Items cannot be empty');
        }
        foreach ($orderItems as $item) {
            if (!$item instanceof OrderItem) {
                throw new DomainException('Invalid Order Item');
            }
        }
    }
    public function changeOrderStatus(OrderStatus $newStatus): void
    {
        $this->validateChangeOrderStatus($newStatus);
        $this->status = $newStatus;
    }
    private function validateChangeOrderStatus(OrderStatus $newStatus): void
    {
        if ($this->status === $newStatus) {
            throw new OrderStatusException('Order status cannot be changed to the same status');
        }

        if ($this->status === OrderStatus::DELIVERED) {
            throw new OrderStatusException('Cannot change order status after being delivered');
        }

        if ($this->status === OrderStatus::CANCELLED) {
            throw new OrderStatusException('Cannot change status of a cancelled order');
        }

        if ($this->status === OrderStatus::REFUSED) {
            throw new OrderStatusException('Cannot change status of a Refused order');
        }

        if ($this->payment->getStatus() !== PaymentStatus::PAID && $newStatus !== OrderStatus::CANCELLED) {
            throw new OrderStatusException('Cannot change order status before payment is made');
        }


        $validTransitions = [
            OrderStatus::AWAITING_PAYMENT->name => [OrderStatus::PENDING, OrderStatus::CANCELLED],
            OrderStatus::PENDING->name => [OrderStatus::REFUSED, OrderStatus::CONFIRMED, OrderStatus::CANCELLED],
            OrderStatus::CONFIRMED->name => [OrderStatus::INDELIVERY, OrderStatus::CANCELLED],
            OrderStatus::INDELIVERY->name => [OrderStatus::DELIVERED, OrderStatus::CANCELLED],
        ];



        $transition = $validTransitions[$this->status->name] ?? [];
        if (!in_array($newStatus, $transition)) {
            throw new OrderStatusException(
                "Invalid transition from {$this->status->name}, to {$newStatus->name}"
            );
        }
    }

    public function addOrderItem(OrderItem $item): void
    {
        array_push($this->orderItems, $item);
        $this->total = $this->calculateTotal();
    }
    public function getStatus(): OrderStatus
    {
        return $this->status;
    }
    public function getTotal(): float
    {
        return $this->total;
    }
    public function getCustomer(): User
    {
        return $this->customer;
    }
    public function getOrderItems(): array
    {
        return $this->orderItems;
    }
    public function getPayment(): OrderPayment
    {
        return $this->payment;
    }
    public function getDelivery(): Delivery
    {
        return $this->delivery;
    }
    public function cancel()
    {
        $this->changeOrderStatus(OrderStatus::CANCELLED);
    }
    public function refused()
    {
        $this->changeOrderStatus(OrderStatus::REFUSED);
    }
}
