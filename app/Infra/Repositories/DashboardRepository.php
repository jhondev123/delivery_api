<?php

namespace App\Infra\Repositories;

use App\Models\Order;

class DashboardRepository
{
    public function getLatestOrders()
    {
        return Order::latest()->limit(5)->get();
    }
    public function getSales($initialDate, $finalDate)
    {
        return Order::select('status', Order::raw('SUM(total) as salesTotal'))
            ->whereBetween('updated_at', [$initialDate, $finalDate])
            ->groupBy('status')
            ->get();
    }
    public function getTotalOrders($initialDate, $finalDate)
    {
        return Order::select('status', Order::raw('COUNT(*) as total'))
            ->whereBetween('updated_at', [$initialDate, $finalDate])
            ->groupBy('status')
            ->get();
    }
    public function getOrdersByStatus($initialDate, $finalDate, $status)
    {
        return Order::whereBetween('updated_at', [$initialDate, $finalDate])
            ->where('status', $status)
            ->get();
    }
}
