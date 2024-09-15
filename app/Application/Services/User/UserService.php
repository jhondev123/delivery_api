<?php

namespace App\Application\Services\User;

use App\Application\DTO\User\UserDTO;
use App\Domain\VO\Address;
use App\Infra\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(private UserRepository $userRepository) {}

    public function getByUserId(string $id): UserDTO
    {
        $userData = $this->userRepository->getUserById($id);
        $addresses = [];
        foreach ($userData->addresses as $address) {
            array_push($addresses, new Address(
                street: $address->street,
                city: $address->city,
                state: $address->state,
                country: $address->country,
                district: $address->district,
                number: $address->number,
                complement: $address->complement,
                zipCode: $address->zip_code,
                id: $address->id
            ));
        }
        return new UserDTO(
            name: $userData->name,
            email: $userData->email,
            password: $userData->password,
            phone: $userData->phone,
            address: $addresses,
            isAdmin: $userData->is_admin,
            id: (string)$userData->id
        );
    }
    public function index($search)
    {
        return $this->userRepository->getAllUsers($search);
    }
    public function show(string $id)
    {
        return $this->userRepository->getUserById($id);
    }
    public function destroy(string $id)
    {
        if ($id == Auth::user()->id) {
            throw new Exception('You cannot delete yourself');
        }
        $this->userRepository->deleteUser($id);
    }
}
