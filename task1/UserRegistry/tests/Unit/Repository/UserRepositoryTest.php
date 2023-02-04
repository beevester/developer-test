<?php

namespace Tests\Unit\Repository;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserRepositoryTest extends TestCase implements RepositoryTest
{
    use RefreshDatabase;

    /**
     * @var UserRepository
     */
    private $userRepo;

    protected function setUp()
    {
        parent::setUp();
        $this->userRepo = (new UserRepository(new User(), new RoleRepository(new Role())));
    }

    public function test_database_connection_down()
    {
        Config::set('database.default', 'mysql');

        $this->expectException(QueryException::class);

        DB::table('user')->first();
    }

    public function test_table_insert_passes()
    {
        $record = factory(User::class, 3);
        $record->raw(['password' => 'password']);
        $this->assertDatabaseMissing('users', $record->make()->toArray());
        $record->create();
        $this->assertDatabaseHas('users', ['id' => 1]);
    }

    public function test_get_all_should_pass()
    {
        factory(User::class, 3)->create();
        $repo = $this->userRepo->usersIndex();

        $this->assertInstanceOf(Collection::class, $repo);
    }

    public function test_get_all_should_return_null()
    {
        $repo = $this->userRepo->usersIndex();
        $this->assertEmpty( $repo);
    }

    public function test_get_by_id_should_return()
    {
        $users = factory(User::class, 3)->create();
        $repo = $this->userRepo->findById(1);

        $this->assertEquals($users[0]->attributes, $repo->attributes);
    }

    public function test_password_is_hashed()
    {
        $user = factory(User::class)->create();

        $this->assertTrue(password_verify($user->password, $user->password));
    }

    public function test_sql_injection()
    {
        $user = factory(User::class)->create();

        $sqlInjection = "john'); DROP TABLE users; --";
        $user->update(['name' => $sqlInjection]);

        $this->assertDatabaseMissing('users', [
            'name' => $sqlInjection,
        ]);
    }

    public function test_user_role_changed_successfully()
    {
        $user = factory(User::class)->create();
        $user->roles()->attach(factory(Role::class)->create());
        $newRole = factory(Role::class)->create(['name' => 'admin']);

        $update = $this->userRepo->update($user->id, $user->first_name, $user->last_name, $user->email, $newRole->id);

        $this->assertEquals($update->roles[0]->name, $newRole->name);
    }

    public function test_delete_by_id_should_return()
    {
        factory(User::class)->create();

        $this->userRepo->delete(1);
        $result = $this->userRepo->findById(1);

        $this->assertEmpty($result);
    }
}
