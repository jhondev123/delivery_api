<?php

namespace App\Infra\Repositories;

use App\Domain\Entities\Group;
use App\Models\Group as GroupModel;

final class GroupRepository
{
    public function getAllGroups()
    {
        return GroupModel::all();
    }
    public function getGroupById(string $id)
    {
        return GroupModel::findOrFail($id);
    }
    public function store(Group $group)
    {
        $groupModel = new GroupModel();
        $groupModel->name = $group->getName();
        $groupModel->save();
        return $groupModel;
    }
    public function update(string $id, Group $group)
    {
        $groupModel = GroupModel::findOrFail($id);
        $groupModel->name = $group->getName();
        $groupModel->save();
        return $groupModel;
    }
    public function delete(string $id): bool
    {
        $groupModel = GroupModel::findOrFail($id);
        return $groupModel->delete();
    }
}
