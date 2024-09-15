<?php

namespace App\Application\Mappers\Order;

use App\Domain\VO\Email;
use App\Domain\VO\Phone;
use App\Domain\VO\Address;
use App\Domain\Entities\User;
use App\Domain\Entities\Group;
use App\Domain\Entities\Product;
use App\Domain\Enums\OrderStatus;
use App\Models\Order as OrderModel;
use App\Domain\Entities\Order\Order;
use App\Domain\Entities\Order\Delivery;
use App\Domain\Entities\Order\OrderItem;
use App\Domain\Entities\Order\OrderPayment;

class OrderMapper
{
    public static function createOrder(Delivery $delivery, array $orderItems, OrderPayment $orderPayment, User $user, OrderStatus $orderStatus): Order
    {
        return new Order($orderItems, $orderPayment, $user, $delivery, $orderStatus);
    }
    public static function createOrderItems(array $products): array
    {
        $orderItems = [];
        foreach ($products as $product) {
            $orderItems[] = new OrderItem(
                new Product(
                    $product['name'],
                    $product['description'],
                    $product['price'],
                    new Group($product['group']['name']),
                    $product['id']
                ),
                $product['pivot']['quantity']
            );
        }
        return $orderItems;
    }
    public static function createUser(OrderModel $order): User
    {
        return new User(
            $order->user->first()->name,
            new Address(
                $order->user->addresses->first()->street,
                $order->user->addresses->first()->city,
                $order->user->addresses->first()->state,
                $order->user->addresses->first()->country,
                $order->user->addresses->first()->district,
                $order->user->addresses->first()->number,
                $order->user->addresses->first()->complement,
                $order->user->addresses->first()->zip_code,
            ),
            new Email($order->user->first()->email),
            new Phone($order->user->first()->phone),
            $order->first()->is_admin === 1,
            $order->user->password,
            $order->user->first()->id,
        );
    }
    public static function createDelivery(OrderModel $order): Delivery
    {
        return  new Delivery(
            $order->delivery->first()->price,
            new Address(
                $order->delivery->address->first()->street,
                $order->delivery->address->first()->city,
                $order->delivery->address->first()->state,
                $order->delivery->address->first()->country,
                $order->delivery->address->first()->district,
                $order->delivery->address->first()->number,
                $order->delivery->address->first()->complement,
                $order->delivery->address->first()->zip_code,

            ),
            new \DateTime($order->delivery->first()->delivery_forecast),
        );
    }
}
