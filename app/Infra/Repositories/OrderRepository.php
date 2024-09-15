<?php

namespace App\Infra\Repositories;

use App\Domain\VO\Email;
use App\Domain\VO\Phone;
use App\Domain\VO\Address;
use App\Models\OrderProduct;
use App\Domain\Entities\User;
use App\Domain\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use App\Domain\Enums\PaymentStatus;
use App\Models\Order as OrderModel;
use App\Domain\Entities\Order\Order;
use App\Domain\Enums\PaymentMethods;
use App\Domain\Entities\Order\Delivery;
use App\Domain\Entities\Order\OrderPayment;
use App\Application\DTO\Order\StoreOrderDTO;
use App\Application\DTO\Order\UpdateOrderDTO;
use App\Application\Mappers\Order\OrderMapper;

class OrderRepository
{
    public function getAllOrders()
    {
        return OrderModel::with('products')->get();
    }
    public function getOrderById(string $id)
    {
        return OrderModel::with('products', 'delivery.address', 'payment')->findOrFail($id);
    }
    public function getOrderByIdToAdmin(string $id)
    {
        return OrderModel::with(['products.group', 'delivery.address', 'payment', 'user.addresses'])
            ->where('id', $id)
            ->firstOrFail();
    }
    public function getOrderByIdToEntity(string $orderId): Order
    {
        $order = OrderModel::with(['products.group', 'delivery.address', 'payment', 'user.addresses'])
            ->where('id', $orderId)
            ->firstOrFail();

        $orderItems = OrderMapper::createOrderItems($order->products->toArray());

        $orderPayment = new OrderPayment(
            PaymentMethods::from($order->payment->first()->payment_method_id),
            PaymentStatus::from($order->payment->first()->status),
        );

        $user = OrderMapper::createUser($order);
        $delivery = OrderMapper::createDelivery($order);

        return OrderMapper::createOrder($delivery, $orderItems, $orderPayment, $user, OrderStatus::from($order->status));
    }
    public function getUserOrdersWithProductsAndToppings($userId)
    {
        $orders = OrderModel::with(['products', 'delivery'])
            ->where('user_id', $userId)
            ->get();
        return $orders;
    }
    public function store(Order $order)
    {
        $orderModel = new OrderModel();
        $orderModel->user_id = $order->getCustomer()->getId();
        $orderModel->status = $order->getStatus()->getValue();
        $orderModel->total = $order->getTotal();
        $orderModel->save();
        $this->storeProductsInOrder($orderModel, $order->getOrderItems());
        $this->storeDelivery($orderModel, $order->getDelivery());
        $this->storeOrderPayment($orderModel, $order->getPayment());
        return $orderModel;
    }

    public function storeProductsInOrder(OrderModel $orderModel, array $orderItems)
    {
        foreach ($orderItems as $product) {
            $orderModel->products()->attach($product->getProduct()->getId(), [
                'quantity' => $product->getQuantity(),
                'price' => $product->getProduct()->getPrice(),
                "total" => $product->calculateTotalPriceItem()
            ]);

            $this->attachToppingsToOrderProduct($orderModel, $product);
        }
    }
    public function storeOrderPayment(OrderModel $orderModel, OrderPayment $orderPayment)
    {
        $orderModel->payment()->create([
            'payment_method_id' => $orderPayment->getMethod()->value,
            'status' => $orderPayment->getStatus()->value,
        ]);
    }

    public function attachToppingsToOrderProduct(OrderModel $orderModel, $product)
    {
        $orderProduct = OrderProduct::where('order_id', $orderModel->id)
            ->where('product_id', $product->getProduct()->getId())
            ->latest('id')
            ->first();

        if ($orderProduct) {
            foreach ($product->getToppings() as $topping) {
                $orderProduct->toppings()->attach($topping->getId());
            }
        }
    }
    public function storeDelivery(OrderModel $order, Delivery $delivery)
    {
        $order->delivery()->create([
            'price' => $delivery->getPrice(),
            'address_id' => $delivery->getAddress()->getId(),
            'delivery_forecast' => $delivery->getDeliveryForeCast()->format('Y-m-d H:i:s')
        ]);
    }

    public function cancelOrder(Order $order) {}
    public function refusedOrder(Order $order) {}
}
