<?php

namespace App\Application\DTO;

use App\Domain\VO\Address;

class AddressDTO
{
    public function __construct(
        public string $street,
        public string $city,
        public string $state,
        public string $country,
        public string $district,
        public string $number,
        public string $complement,
        public string $zipCode
    ) {}
    public function toEntity()
    {
        return new Address(
            $this->street,
            $this->city,
            $this->state,
            $this->country,
            $this->district,
            $this->number,
            $this->complement,
            $this->zipCode
        );
    }
}
