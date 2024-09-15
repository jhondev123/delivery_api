<?php

namespace App\Infra\services\AddressValidator;

use App\Domain\interfaces\AddressValidator;

class ViacepAddressValidator implements AddressValidator
{
    public function validateZipCode(string $zipCode): void
    {
        $url = "https://viacep.com.br/ws/{$zipCode}/json/";
        $response = file_get_contents($url);
        $data = json_decode($response);
        if (isset($data->erro)) {
            throw new \InvalidArgumentException('Invalid zip code');
        }
    }
}
