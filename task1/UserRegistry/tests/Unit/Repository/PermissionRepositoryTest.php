<?php

namespace Tests\Unit\Repository;

use App\Permission;
use App\Repositories\PermissionRepository;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionRepositoryTest extends TestCase implements RepositoryTest
{
    use RefreshDatabase;

    /**
     * @var PermissionRepository
     */
    private $permissionRepo;

    protected function setUp()
    {
        parent::setUp();

        $this->permissionRepo = (new PermissionRepository(new Permission()));
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
        factory(Permission::class, 3)->create();

        $repo = $this->permissionRepo->all();
        $this->assertInstanceOf(Collection::class, $repo);

    }

    public function test_get_by_id_should_return()
    {
        // TODO: Implement test_get_by_id_should_return() method.
    }

    public function test_delete_by_id_should_return()
    {
        // TODO: Implement test_delete_by_id_should_return() method.
    }

    public function test_sql_injection()
    {
        // TODO: Implement test_sql_injection() method.
    }
}
