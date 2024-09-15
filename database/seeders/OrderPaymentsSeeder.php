<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrderPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderPayments = [
            ['order_id' => 1, 'payment_method_id' => 1,'status'=>'paid','created_at' => date('Y-m-d H:i:s')],
        ];

        foreach ($orderPayments as $orderPayment) {
            DB::table('order_payments')->insert($orderPayment);
        }
        
    }
}
