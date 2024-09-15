<?php

namespace Database\Seeders;

use App\Domain\Entities\Order\OrderPayment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PSpell\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PaymentMethodsSeeder::class,
            UserAdminSeeder::class,
            GroupSeeder::class,
            ProductSeeder::class,
            ToppingsSeeder::class,
            OrderSeeder::class,
            OrderPaymentsSeeder::class,
            ConfigSeeder::class,

        ]);
    }
}
