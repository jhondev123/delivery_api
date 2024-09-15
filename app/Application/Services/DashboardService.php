<?php

namespace App\Application\Services;

use DateTimeInterface;
use App\Infra\Repositories\DashboardRepository;

class DashboardService
{
    public function __construct(private DashboardRepository $repository) {}
    public function index(DateTimeInterface $initialDate, DateTimeInterface $finalDate): array
    {
        $salesData = $this->getSales($initialDate, $finalDate);
        $latestOrders = $this->getLatestOrders();
        $totalsOrders = $this->getTotalsOrders($initialDate, $finalDate);
        return [
            'salesData' => $salesData,
            'latestOrders' => $latestOrders,
            'totalsOrders' => $totalsOrders
        ];
    }

    public function getSales(DateTimeInterface $initialDate, DateTimeInterface $finalDate)
    {
        return $this->repository->getSales($initialDate->format('Y-m-d'), $finalDate->format('Y-m-d'));
    }
    public function getLatestOrders()
    {
        return $this->repository->getLatestOrders();
    }

    public function getTotalsOrders(DateTimeInterface $initialDate, DateTimeInterface $finalDate)
    {
        return $this->repository->getTotalOrders($initialDate->format('Y-m-d'), $finalDate->format('Y-m-d'));
    }
    public function getOrdersByStatus(DateTimeInterface $initialDate, DateTimeInterface $finalDate, string $status)
    {
        return $this->repository->getOrdersByStatus($initialDate->format('Y-m-d'), $finalDate->format('Y-m-d'), $status);
    }
}
