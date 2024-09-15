<?php

namespace App\Application\Services;

use DateTime;
use App\Facades\DbConfig;
use App\Domain\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use App\Domain\Enums\PaymentStatus;
use App\Domain\Entities\Order\Order;
use App\Domain\Enums\PaymentMethods;
use App\Domain\Entities\Order\Delivery;
use App\Domain\Entities\Order\OrderItem;
use App\Domain\Entities\Order\OrderPayment;
use App\Infra\Repositories\OrderRepository;
use App\Application\DTO\Order\StoreOrderDTO;
use App\Application\Mappers\DeliveryMapper;
use App\Application\Services\User\UserService;
use App\Application\Mappers\Order\OrderItemsMapper;
use App\Application\Mappers\Order\OrderMapper;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private ProductsServices $productService,
        private ToppingsService $toppingService,
        private UserService $userService
    ) {}
    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }
    public function getOrderById(string $id)
    {
        return $this->orderRepository->getOrderById($id);
    }
    public function store(StoreOrderDTO $dto)
    {
        $status = OrderStatus::AWAITING_PAYMENT;

        $userDto = $this->userService->getByUserId($dto->user_id);
        $user = $userDto->toEntity();

        $addressSelected = $user->getAddressById($dto->address_id);
        $delivery = DeliveryMapper::createDelivery($addressSelected, $status);

        $orderItems = OrderItemsMapper::createOrderItems($dto->items, $this->productService, $this->toppingService);

        $orderPayment = new OrderPayment(
            PaymentMethods::from($dto->payment_method),
            PaymentStatus::PENDING
        );

        $order = OrderMapper::createOrder($delivery, $orderItems, $orderPayment, $user, $status);

        DB::beginTransaction();
        try {
            $createdOrder = $this->orderRepository->store($order);
            DB::commit();
            return $createdOrder;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
    public function getOrderByUserId(string $id)
    {
        return $this->orderRepository->getUserOrdersWithProductsAndToppings($id);
    }
    public function cancelOrder(string $orderId)
    {
        $order = $this->orderRepository->getOrderByIdToEntity($orderId);
        $order->cancel();
    }
    public function getOrderByUserIdToAdmin(string $id)
    {
        return $this->orderRepository->getOrderByIdToAdmin($id);
    }
}
