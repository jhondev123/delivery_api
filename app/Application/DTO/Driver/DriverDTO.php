<?php

namespace App\Application\DTO\Driver;

use App\Domain\VO\Phone;
use App\Domain\Entities\Driver;

class DriverDTO
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $vehicle,
        public string $plate,
        public ?string $id = null
    ) {}
    public function toEntity(): Driver
    {
        return new Driver($this->name, new Phone($this->phone), $this->vehicle, $this->plate);
    }
    public function entityToDto(Driver $driver): DriverDTO
    {
        return new DriverDTO(
            $driver->getName(),
            (string)$driver->getPhone(),
            $driver->getVehicle(),
            $driver->getPlate(),
            $driver->getId()
        );
    }
}
