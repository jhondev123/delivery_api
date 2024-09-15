<?php

namespace App\Http\Controllers;

use App\Application\DTO\Order\StoreOrderDTO;
use DateTime;
use App\Facades\DbConfig;
use Illuminate\Http\Request;
use App\Domain\Entities\User;
use App\Domain\Enums\OrderStatus;
use App\Domain\Enums\PaymentStatus;
use App\Domain\Entities\Order\Order;
use App\Domain\Enums\PaymentMethods;
use App\Domain\Entities\Order\Delivery;
use App\Domain\Entities\Order\OrderItem;
use App\Http\Requests\StoreOrderRequest;
use App\Application\Services\OrderService;
use App\Domain\Entities\Order\OrderPayment;
use App\Application\Services\ToppingsService;
use App\Application\Services\ProductsServices;
use App\Application\Services\User\UserService;

class OrdersController extends Controller
{
    public function __construct(
        private OrderService $orderService,
        private ProductsServices $productService,
        private ToppingsService $toppingService,
        private UserService $userService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function getProductByUserId($id)
    {
        return response()->json($this->orderService->getOrderByUserId($id));
    }


    public function store(StoreOrderRequest $request)
    {
        try {
            $dto = new StoreOrderDTO(
                $request->address_id,
                $request->user_id,
                $request->items,
                $request->payment_method
            );

            $order = $this->orderService->store($dto);
            return response()->json(['message' => 'Order created successfully', 'data' => $order], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating order, ' . $e->getMessage()], 500);
        }
    }


    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
