<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating UserSeeder, Role and Permission tables');
        $this->truncateTables();

        // Create a new roles as per spec
        $roleAdmin = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'UserSeeder has the role as an admin'
        ]);

        $this->command->info('Creating Role admin');

        $roleContentManager = Role::create([
            'name' => 'content_manager',
            'display_name' => 'Content Manager',
            'description' => 'UserSeeder has the role as a Content Manager'
        ]);

        $this->command->info('Creating Role content manager');

        $roleUser = Role::create([
            'name' => 'user',
            'display_name' => 'UserSeeder',
            'description' => 'Basic UserSeeder'
        ]);

        $this->command->info('Creating Role user');

        $permissionAdminister = Permission::create([
            'name' => 'administer_users',
            'display_name' => 'Administer Users',
            'description' => 'UserSeeder with this permission is able to create, delete, edit, and view users of the system'
        ]);

        $permissionViewAdminDashBoard = Permission::create([
            'name' => 'view_admin_dashboard',
            'display_name' => 'View Admin Dashboard',
            'description' => 'UserSeeder with this permission is able to view Admin dashboard'
        ]);


        $roleAdmin->attachPermissions([$permissionAdminister, $permissionViewAdminDashBoard]);
        $roleContentManager->attachPermissions([$permissionViewAdminDashBoard]);

        $this->command->info("Creating Super user");
        $user = User::create([
            'first_name' => 'Super',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
        $user->attachRole($roleAdmin);
        $this->command->info("Super user created!");
    }

    public function truncateTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        User::truncate();
        Role::truncate();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
