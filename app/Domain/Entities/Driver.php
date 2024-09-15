<?php

namespace App\Domain\Entities;

use App\Domain\VO\Phone;

final class Driver
{

    public function __construct(
        private string $name,
        private Phone $phone,
        private string $vehicle,
        private string $plate,
        private ?string $id = null
    ) {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }
    //getters
    public function getPhone(): Phone
    {
        return $this->phone;
    }
    public function getVehicle(): string
    {
        return $this->vehicle;
    }
    public function getPlate(): string
    {
        return $this->plate;
    }
    public function getId(): string
    {
        return $this->id;
    }
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}
