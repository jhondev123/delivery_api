<?php

namespace App\Domain\Entities;

use App\Domain\VO\Email;
use App\Domain\VO\Phone;
use App\Domain\VO\Address;
use App\Domain\VO\Password;

final class User
{
    private string $name;
    private array $address = [];
    private Email $email;
    private Phone $phoneNumber;
    private bool $isAdmin;
    private string $password;
    public function __construct(
        string $name,
        Address|array $address,
        Email $email,
        Phone $phoneNumber,
        bool $isAdmin,
        string $password,
        private ?string $id = null
    ) {
        $this->name = $name;
        if ($address instanceof Address) {
            array_push($this->address, $address);
        } else {
            $this->validateAddressesArray($address);
            $this->address = $address;
        }
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->isAdmin = $isAdmin;
        $this->password = $password;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getAddresses(): array
    {
        return $this->address;
    }
    public function getEmail(): Email
    {
        return $this->email;
    }
    public function getPhoneNumber(): Phone
    {
        return $this->phoneNumber;
    }
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function addAddress(Address $address): void
    {
        array_push($this->address, $address);
    }
    public function validateAddressesArray(array $addresses): void
    {
        if (empty($addresses)) {
            throw new \InvalidArgumentException("Addresses array cannot be empty.");
        }
    }
    public function getAddressById(string $id)
    {
        foreach ($this->address as $address) {
            if ($address->getId() === $id) {
                return $address;
            }
        }
        throw new \InvalidArgumentException("Address not found.");
    }
    public function getId(): string
    {
        return $this->id;
    }
}
