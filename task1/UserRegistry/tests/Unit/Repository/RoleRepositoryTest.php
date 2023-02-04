<?php

namespace Tests\Unit\Repository;

use App\Permission;
use App\Repositories\RoleRepository;
use App\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleRepositoryTest extends TestCase implements RepositoryTest
{
    use RefreshDatabase;

    /**
     * @var RoleRepository
     */
    private $roleRepo;

    protected function setUp()
    {
        parent::setUp();
        $this->roleRepo = (new RoleRepository(new Role()));
    }

    public function test_sql_injection()
    {
        // TODO: Implement test_sql_injection() method.
    }

    public function test_database_connection_down()
    {
        // TODO: Implement test_database_connection_down() method.
    }

    public function test_table_insert_passes()
    {
        // TODO: Implement test_table_insert_passes() method.
    }

    public function test_get_all_should_pass()
    {
        factory(Role::class, 3)->create();
        $repo = $this->roleRepo->all();

        $this->assertInstanceOf(Collection::class, $repo);
    }

    public function test_get_by_id_should_return()
    {
        $user = factory(Role::class)->create();
        $repo = $this->roleRepo->findById(1);

        $this->assertEquals($user->id, $repo->id);
    }

    public function test_delete_by_id_should_return()
    {
        // TODO: Implement test_delete_by_id_should_return() method.
    }

    public function test_get_role_with_permissions()
    {
        $role = factory(Role::class)->create();
        $role->attachPermissions(factory(Permission::class, 3)->create());

        $repo = $this->roleRepo->getRoleWithPermissions();
        dd($repo);
        $this->assertNotEmpty($repo->permissions);
    }
}
