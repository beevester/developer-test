<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(User $user, RoleRepository $roleRepository
)
    {
        $this->user = $user;
        $this->roleRepository = $roleRepository;
    }

    public function usersIndex($item = 10)
    {
        return $this->user::paginate($item);
    }

    public function createUser($firstName, $lastName, $email, $password)
    {
        return $this->user::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }

    public function findById(int $id)
    {
        return $this->user::find($id);
    }

    public function delete(int $id)
    {
        $user = $this->findById($id);
        // Detach from Role
        $roles = $user->roles;

        foreach ($roles as $value) {
            $user->detachRole($value);
        }

        $user->delete();
    }

    public function update($id, $firstName, $lastName, $email, $positionId)
    {
        $user = $this->findById($id);

        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $email;

        $user->save();

        $roles = $user->roles;

        foreach ($roles as $value) {
            $user->detachRole($value);
        }

        $role = $this->roleRepository->findById($positionId);

        $user->attachRole($role);

        return $this->findById($id);
    }
}
