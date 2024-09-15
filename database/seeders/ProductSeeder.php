<?php

namespace Database\Seeders;

use App\Models\Product as ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        ProductModel::create([
            'name' => 'Produto 1',
            'description' => 'Descrição do Produto 1',
            'price' => 10.99,
            'group_id' => 1,
        ]);
    }
}
