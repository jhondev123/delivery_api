<?php

namespace App\Domain\Entities;

final class Product
{
    private string $name;
    private string $description;
    private float $price;
    private Group $group;

    public function __construct(
        string $name,
        string $description,
        float $price,
        Group $group,
        private ?string $id = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->group = $group;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getGroup(): Group
    {
        return $this->group;
    }
    public function getGroupName(): string
    {
        return $this->group->getName();
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function getId(): string
    {
        return $this->id;
    }
}
