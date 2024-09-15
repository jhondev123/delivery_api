<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            ['name' => 'Cartão de crédito', 'description' => '', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cartão de débito', 'description' => '', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pix', 'created_at'  => now(), 'description' => '', 'updated_at' => now()],
            ['name' => 'Dinheiro', 'created_at' => now(), 'description' => '', 'updated_at' => now()],
        ]);
    }
}
