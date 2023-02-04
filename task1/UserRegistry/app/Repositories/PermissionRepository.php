<?php

namespace App\Repositories;


use App\Permission;

class PermissionRepository
{
    /**
     * @var Permission
     */
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function all()
    {
        return $this->permission::all();
    }
}
