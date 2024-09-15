<?php

namespace App\Domain\interfaces;

interface AddressValidator
{
    public function validateZipCode(string $zipCode): void;

}
