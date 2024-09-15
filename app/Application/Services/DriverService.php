<?php

namespace App\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Infra\Repositories\DriverRepository;
use App\Application\DTO\Driver\DriverDTO;

class DriverService
{
    public function __construct(private DriverRepository $driverRepository) {}
    public function getAllDrivers()
    {
        $this->driverRepository->getAll();
    }
    public function getDeliveryById(string $id)
    {
        $this->driverRepository->getById($id);
    }
    public function store(DriverDTO $dto)
    {
        $driver = $dto->toEntity();
        DB::beginTransaction();
        try {
            $createdDriver = $this->driverRepository->store($driver);
            DB::commit();
            return $dto->entityToDto($createdDriver);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error to store driver: ' . $e->getMessage());
        }
    }
    public function update(DriverDTO $dto, string $id)
    {
        $driver = $dto->toEntity();
        $driver->setId($id);
        DB::beginTransaction();
        try {
            $updatedDriver = $this->driverRepository->update($driver, $id);
            DB::commit();
            return $dto->entityToDto($updatedDriver);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error to update driver: ' . $e->getMessage());
        }
    }
    public function delete(string $id)
    {
        return $this->driverRepository->delete($id);
    }
}
