<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Address as AddressModel;
use App\Models\Phone as PhoneModel;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Jhon99681424$'),
            'phone' => '45999681424',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        AddressModel::create([
            'user_id' => 1,
            'street' => 'Rua antonia rotta ribeiro',
            'number' => '67',
            'district' => 'esmeralda',
            'city' => 'Cascavel',
            'state' => 'PR',
            'country' => 'Brasil',
            'zip_code' => '85806252',
            'complement' => 'começo da rua'
        ]);
    }
}
