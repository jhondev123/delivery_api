<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order as OrderModel;
use App\Models\Order_product as OrderProductModel;
use App\Models\Order_product_topping as OrderProductTopping;
use App\Models\Delivery as DeliveryModel;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        OrderModel::create([
            'user_id' => 1,
            'status' => 'pending',
            'total' => 25,
        ]);

        DeliveryModel::create([
            'order_id' => 1,
            'address_id' => '1',
            'price' => 25,
            'delivery_forecast' => new \DateTime('2022-01-01 12:00'),
        ]);

        OrderProductModel::create([
            'product_id' => 1,
            'order_id' => 1,
            'quantity' => 2,
            'price' => 25,
            'total' => 50,
        ]);
        OrderProductTopping::create([
            'order_product_id' => 1,
            'topping_id' => 1,
        ]);
    }
}
