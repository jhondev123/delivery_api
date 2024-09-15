<?php

namespace App\Application\DTO\User;

use App\Domain\VO\Email;
use App\Domain\VO\Phone;
use App\Domain\Entities\User;

class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $phone,
        public bool $isAdmin,
        public array $address,
        public ?string $id = null,
    ) {}

    public function toEntity(): User
    {
        return new User(
            name: $this->name,
            address: $this->address,
            email: new Email($this->email),
            phoneNumber: new Phone($this->phone),
            isAdmin: $this->isAdmin,
            password: $this->password,
            id: $this->id
        );
    }
}
