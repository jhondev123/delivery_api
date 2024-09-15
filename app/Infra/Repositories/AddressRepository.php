<?php

namespace App\Infra\Repositories;

use App\Models\User;
use App\Domain\VO\Address;
use App\Models\Address as AddressModel;

class AddressRepository
{
    public function store(Address $address, string $userId)
    {
        $user = User::findOrFail($userId);
        $addressModel = new AddressModel();
        $addressModel->street = $address->getStreet();
        $addressModel->city = $address->getCity();
        $addressModel->state = $address->getState();
        $addressModel->country = $address->getCountry();
        $addressModel->district = $address->getDistrict();
        $addressModel->number = $address->getNumber();
        $addressModel->complement = $address->getComplement();
        $addressModel->zip_code = $address->getZipCode();
        return $user->addresses()->save($addressModel);
    }
    public function destroy(string $id)
    {
        $address = AddressModel::findOrFail($id);
        return $address->delete();
    }
}
