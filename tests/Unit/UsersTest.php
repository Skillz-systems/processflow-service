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
            "name" => "Process Flow 1",
            "id" => 1,
            "email" => "test.nnpc.com",

        ]);

        $createNewProcessService = new UserService();
        $result = $createNewProcessService->createUser($data);

        $this->assertDatabaseHas('users', $data->all());
        $this->assertInstanceOf(User::class, $result);

    }

    public function test_to_see_if_validation_error_is_sent_when_an_error_occurs_while_creating_a_new_user(): void
    {
        $data = new Request([
            "name" => "Process Flow 1",
            "id" => 1,

        ]);

        $createNewProcessService = new UserService();
        $result = $createNewProcessService->createUser($data);

        $resultArray = $result->toArray();
        $this->assertNotEmpty($result);
        $this->assertIsArray($resultArray);
        $this->assertArrayHasKey('email', $resultArray);

    }

    public function test_to_see_if_a_user_can_be_fetched(): void
    {

        $data = new Request([
            "id" => 1,
            "name" => "Process Flow 1",
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
}
