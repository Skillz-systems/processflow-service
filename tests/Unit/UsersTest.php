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
    public function test(): void
    {
        $data = new Request([
            "name" => "Process Flow 1",
            "id" => 1,
            "email" => "daily",

        ]);

        $createNewProcessService = new UserService();
        $result = $createNewProcessService->createUser($data);

        $this->assertDatabaseHas('users', $data->all());
        $this->assertInstanceOf(User::class, $result);

    }
}
