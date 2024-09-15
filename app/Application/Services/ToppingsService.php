<?php

namespace App\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Application\DTO\Topping\ToppingDTO;
use App\Domain\Entities\Topping;
use App\Infra\Repositories\ToppingRepository;

final class ToppingsService
{
    public function __construct(private ToppingRepository $toppingRepository) {}
    public function getAllToppings()
    {
        return $this->toppingRepository->getAllToppings();
    }
    public function getToppingById(string $id)
    {
        return $this->toppingRepository->getToppingById($id);
    }
    public function getToppingByIdToEntity(string $id): Topping
    {
        $toppingData = $this->toppingRepository->getToppingById($id);
        return new Topping(
            $toppingData->name,
            $toppingData->description,
            $toppingData->price,
            $toppingData->group_id,
            $toppingData->id
        );
    }
    public function store(ToppingDTO $dto)
    {
        try {
            return $this->toppingRepository->store($dto->toEntity());
        } catch (\Exception $e) {
            throw new \Exception('Error creating topping: ' . $e->getMessage());
        }
    }
    public function update(ToppingDTO $dto, string $id)
    {
        $topping = $dto->toEntity();
        try {
            return $this->toppingRepository->update($topping, $id);
        } catch (\Exception $e) {
            throw new \Exception('Error updating topping: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        return $this->toppingRepository->destroy($id);
    }
}
