<?php

namespace App\Repositories;

use App\Role;

class RoleRepository
{

    /**
     * @var Role
     */
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getRoleWithPermissions()
    {
        return $this->role::with('permissions')->get();
    }

    public function all()
    {
        return $this->role::all();
    }

    public function findById($id)
    {
        return $this->role::findOrFail($id);
    }
}
