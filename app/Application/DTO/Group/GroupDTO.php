<?php

namespace App\Application\DTO\Group;

class GroupDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $id = null
    ) {}
}
