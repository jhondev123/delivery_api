<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'Credit Card', "created_at" => now(), "updated_at" => now()],
            ['name' => 'Debit Card', "created_at" => now(), "updated_at" => now()],
            ['name' => 'Money', "created_at" => now(), "updated_at" => now()],
            ['name' => 'Pix', "created_at" => now(), "updated_at" => now()],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            DB::table('payment_methods')->insert($paymentMethod);
        }
    }
}
