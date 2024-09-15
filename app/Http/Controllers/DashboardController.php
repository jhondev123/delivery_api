<?php

namespace App\Http\Controllers;

use App\Application\Services\DashboardService;
use App\Application\Services\OrderService;
use App\Http\Requests\DashboardOrdersRequest;
use App\Http\Requests\DashboardRequest;
use DateTime;

class DashboardController
{
    public function __construct(private DashboardService $service, private OrderService $orderService) {}
    public function index(DashboardRequest $request)
    {
        $initialDate = $request->input('initialDate');
        $finalDate = $request->input('finalDate');
        $data = $this->service->index(new DateTime($initialDate), new DateTime($finalDate));
        return response()->json($data);
    }
    public function orders(DashboardOrdersRequest $request)
    {
        $initialDate = $request->input('initialDate');
        $finalDate = $request->input('finalDate');
        $status = $request->input('status');
        $data = $this->service->getOrdersByStatus(new DateTime($initialDate), new DateTime($finalDate), $status);
        return response()->json($data);
    }
    public function show(string $id)
    {
        $data = $this->orderService->getOrderByUserIdToAdmin($id);
        return response()->json($data);
    }
}
