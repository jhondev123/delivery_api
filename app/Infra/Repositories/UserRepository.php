<?php

namespace App\Infra\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUserById(string $id)
    {
        return User::with('addresses')->findOrFail($id);
    }
    public function getAllUsers($search)
    {
        return  User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->get();
    }
    public function deleteUser(string $id)
    {
        return User::findOrFail($id)->delete();
    }
}
