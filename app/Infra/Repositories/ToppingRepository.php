<?php

namespace App\Infra\Repositories;

use App\Domain\Entities\Topping;
use App\Models\Topping as ToppingModel;

final class ToppingRepository
{
    public function getAllToppings()
    {
        return ToppingModel::all();
    }
    public function getToppingById(string $id): ToppingModel
    {
        return ToppingModel::findOrFail($id);
    }
    public function store(Topping $topping)
    {
        $toppingModel = new ToppingModel();
        $toppingModel->name = $topping->getName();
        $toppingModel->description = $topping->getDescription();
        $toppingModel->price = $topping->getPrice();
        $toppingModel->group_id = $topping->getGroupId();
        $toppingModel->save();
        return $toppingModel;
    }
    public function update(Topping $topping, string $id)
    {
        $toppingModel = ToppingModel::findOrFail($id);
        $toppingModel->name = $topping->getName();
        $toppingModel->description = $topping->getDescription();
        $toppingModel->price = $topping->getPrice();
        $toppingModel->group_id = $topping->getGroupId();
        $toppingModel->save();
        return $toppingModel;
    }
    public function destroy(string $id): bool
    {
        $toppingModel = ToppingModel::findOrFail($id);
        return $toppingModel->delete();
    }
}
