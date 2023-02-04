<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserListingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
    }

    public function test_user_list_show_list_of_user()
    {
        factory(User::class, 3)->create();

        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.users_list');
    }

    public function test_should_show_a_user()
    {
        factory(User::class, 3)->create();

        $response = $this->get('/users/1');

        $response->assertStatus(200);
        $response->assertViewIs('users.users_show');
    }
}
