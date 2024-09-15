<?php

namespace App\Application\Services;

use Illuminate\Http\Request;
use App\Domain\Entities\Group;
use Illuminate\Support\Facades\DB;
use App\Application\DTO\Group\GroupDTO;
use App\Infra\Repositories\GroupRepository;

final class GroupsServices
{
    public function __construct(private GroupRepository $groupRepository) {}
    public function getAllGroups()
    {
        return $this->groupRepository->getAllGroups();
    }

    public function getGroupById(string $id)
    {
        return $this->groupRepository->getGroupById($id);
    }
    public function createGroup(GroupDTO $dto)
    {

        $group = new Group(name: $dto->name);
        return $this->groupRepository->store($group);
    }
    public function update(GroupDTO $dto, string $id)
    {

        $group = new Group(id: $id, name: $dto->name);
        return $this->groupRepository->update($id, $group);
    }
    public function deleteGroup(string $id): bool
    {
        return $this->groupRepository->delete($id);
    }
}
