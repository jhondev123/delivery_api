<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver as DriverModel;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DriverModel::create([
            'name' => 'jhonattan entregas',
            'phone' => '45999338406',
            'vehicle' => 'Toyota Corolla',
            'plate' => 'ABC1234',
        ]);
    }
}
