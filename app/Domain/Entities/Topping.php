<?php

namespace App\Domain\Entities;

final class Topping
{
    private ?string $id = null;
    private string $name;
    private string $description;
    private float $price;
    private string $group_id;

    public function __construct(string $name, string $description, float $price, string $group_id, ?string $id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->group_id = $group_id;
        $this->id = $id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getGroupId(): string
    {
        return $this->group_id;
    }
    public function getId(): string
    {
        return $this->id;
    }
}
