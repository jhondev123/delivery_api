<?php

namespace App\Infra\Repositories;

use App\Domain\Entities\Driver;
use App\Models\Driver as DriverModel;

class DriverRepository
{
    public function getAll()
    {
        return DriverModel::all();
    }
    public function getById(string $id)
    {
        return DriverModel::find($id);
    }
    public function store(Driver $driver): Driver
    {
        $driverModel = new DriverModel();
        $driverModel->name = $driver->getName();
        $driverModel->phone = (string)$driver->getPhone();
        $driverModel->vehicle = $driver->getVehicle();
        $driverModel->plate = $driver->getPlate();
        $createdDriver = $driverModel->save();
        $driver->setId($driverModel->id);
        return $createdDriver ? $driver : null;
    }
    public function update(Driver $driver, string $id): Driver
    {
        $driverModel = DriverModel::findOrFail($id);
        $driverModel->name = $driver->getName();
        $driverModel->phone = (string)$driver->getPhone();
        $driverModel->vehicle = $driver->getVehicle();
        $driverModel->plate = $driver->getPlate();
        $updatedDriver = $driverModel->save();
        return $updatedDriver ? $driver : null;
    }
    public function delete(string $id): bool
    {
        return DriverModel::destroy($id);
    }
}
