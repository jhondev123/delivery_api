<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Config as ConfigModel;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfigModel::create([
            'key' => 'delivery_fee',
            'value' => 5.00,
        ]);
        ConfigModel::create([
            'key' => 'minimum_order',
            'value' => 20.00,
        ]);
        ConfigModel::create([
            'key' => 'max_distance_for_delivery',
            'value' => 10,
        ]);
        ConfigModel::create([
            'key' => 'payment_timeout',
            'value' => 30,
        ]);
    }
}
