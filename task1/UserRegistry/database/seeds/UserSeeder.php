<?php


use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (empty(Role::all()) && empty(Permission::all())) {
            $this->call(RolePermission::class);
        }
        $users = factory(User::class, 100)->create();

        foreach ($users as $user) {
            $user->roles()->attach(Role::find(2));
        }
    }
}
