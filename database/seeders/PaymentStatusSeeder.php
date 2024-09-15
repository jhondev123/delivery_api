<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments_status')->insert([
            ['status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Awaiting Approval', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Completed', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Failed', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
