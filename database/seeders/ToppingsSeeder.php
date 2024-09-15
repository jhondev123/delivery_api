<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topping as ToppingModel;

class ToppingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ToppingModel::create([
            'name' => 'Leite em Pó',
            'description' => '',
            'price' => 1.99,
            'group_id' => 1,
        ]);
    }
}
