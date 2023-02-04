<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->permissions()->attach($permission->id);
        }
    }

    /**
     * Many-to-Many relations with the permission model.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            'App\Permission',
            'permission_role',
            'role_id',
            'permission_id'
        );
    }
}
