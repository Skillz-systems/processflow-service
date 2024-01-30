<?php

namespace Tests\Unit;

use App\Models\User;
use App\Service\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_to_see_if_a_new_user_can_be_created(): void
    {
        $data = new Request([
            "name" => "john doe",
            "id" => 1,
            "email" => "test@nnpc.com",

        ]);

        $user = new UserService();
        $result = $user->createUser($data);

        $this->assertDatabaseHas('users', $data->all());
        $this->assertInstanceOf(User::class, $result);

    }

    public function test_to_see_if_validation_error_is_sent_when_an_error_occurs_while_creating_a_new_user(): void
    {
        $data = new Request([
            "name" => "john doe",
            "id" => 1,

        ]);

        $user = new UserService();
        $result = $user->createUser($data);

        $resultArray = $result->toArray();
        $this->assertNotEmpty($result);
        $this->assertIsArray($resultArray);
        $this->assertArrayHasKey('email', $resultArray);

    }

    public function test_to_see_if_a_user_can_be_fetched(): void
    {

        $data = new Request([
            "id" => 1,
            "name" => "john doe",
            "email" => "example@test.com",
        ]);

        $user = new UserService();
        $result = $user->createUser($data);
        $fetchService = $user->getUser($result->id);
        $this->assertEquals($fetchService->id, $result->id);
        $this->assertInstanceOf(User::class, $fetchService);

    }

    public function test_to_see_if_user_returns_a_content(): void
    {
        $user = new UserService();
        $fetchService = $user->getUser(5);

        $this->assertNull($fetchService);

    }

    public function test_to_see_if_an_existing_user_can_be_updated(): void
    {

        User::factory(5)->create();
        $user = new UserService();
        $fetchService = $user->getUser(1);
        $this->assertDatabaseCount("users", 5);
        $data = new Request([
            "name" => "john doe",
            "email" => "test@nnpc.com",

        ]);
        $user->updateUser($fetchService->id, $data);
        $this->assertDatabaseHas('users', $data->all());
    }

    public function test_to_see_if_exception_would_be_thrown_if_there_is_an_error(): void
    {
        $this->expectException(\Exception::class);
        $user = new UserService();
        $data = new Request([
            "name" => "john doe",
            "email" => 1,
        ]);

        $user->updateUser(1, $data);
        $this->expectExceptionMessage('Something went wrong.');

    }

    public function test_to_if_a_user_can_be_deleted()
    {
        $data = new Request([
            "name" => "john doe",
            "id" => 1,
            "email" => "daily@nnpc.com",
        ]);

        $user = new UserService();
        $data = $user->createUser($data);
        $this->assertDatabaseCount("users", 1);
        $delete = $user->deleteUser($data->id);
        // check ifit was removed fromthe db
        $this->assertDatabaseMissing("users", ["name" => "john doe"]);
        $this->assertTrue($delete);

    }

    public function test_to_see_if_there_is_no_record_with_the_provided_id()
    {
        $user = new UserService();
        $delete = $user->deleteUser(5);
        $this->assertFalse($delete);

    }
}
