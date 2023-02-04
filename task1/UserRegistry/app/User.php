<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Many-to-Many relations with Role.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->morphToMany(
            'App\Role',
            'user',
            'role_user',
            'user_id',
            'role_id'
        );
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     * @return static
     */
    public function attachRole($role): User
    {
        $this->roles()->attach($role->id);

        return $this;
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     * @return static
     */
    public function detachRole($role): User
    {
        $this->roles()->detach($role->id);

        return $this;
    }
}
