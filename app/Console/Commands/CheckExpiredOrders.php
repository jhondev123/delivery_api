<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class CheckExpiredOrders extends Command
{
    protected $signature = 'orders:check-expired';
    protected $description = 'Check and cancel expired orders';

    public function handle()
    {
        $expiredOrders = Order::where('status', 'awaiting_payment')
            ->where('created_at', '<=', Carbon::now()->subMinutes(15))
            ->get();

        foreach ($expiredOrders as $order) {
            $order->update(['status' => 'cancelled']);
            $this->info("Order {$order->id} has been cancelled.");
        }

        $this->info('Expired orders check completed.');
    }
}
