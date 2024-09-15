<?php

namespace App\Application\DTO\Topping;

use App\Domain\Entities\Topping;

class ToppingDTO
{

    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public float $group_id,
        public ?string $id = null
    ){}
    public function toEntity():Topping
    {
        return new Topping(
            $this->name,
            $this->description,
            $this->price,
            $this->group_id,
            $this->id
        );
    }
    public function entityToDto(Topping $topping): ToppingDTO
    {
        return new ToppingDTO(
            $topping->getName(),
            $topping->getDescription(),
            $topping->getPrice(),
            $topping->getGroupId(),
        );    
    }
}
