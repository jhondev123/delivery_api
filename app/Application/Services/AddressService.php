<?php

namespace App\Application\Services;

use App\Application\DTO\AddressDTO;
use App\Domain\interfaces\AddressValidator;
use App\Infra\Repositories\AddressRepository;

class AddressService
{
    public function __construct(private AddressValidator $validator, private AddressRepository $repository) {}
    public function store(AddressDTO $addressDTO, string $userId)
    {
        $this->validator->validateZipCode($addressDTO->zipCode);
        $address = $addressDTO->toEntity();
        return $this->repository->store($address, $userId);
    }
    public function destroy(string $userId)
    {
        $this->repository->destroy($userId);
        
    }
}
