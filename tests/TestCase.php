<?php

namespace Tests;

use Mockery;
use App\Models\User;
use Skillz\UserService;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


public  function actingAsAuthenticatedTestUser(){
    Http::fake([
    env("USERS_MS").'/*' => Http::response('ok', 200),
]);

}
public  function actingAsUnAuthenticatedTestUser(){
    Http::fake([
    env("USERS_MS").'/*' => Http::response('unauthorized', 401),
]);

}


    // public function userCreate()
    // {
    //     Sanctum::actingAs(
    //         User::factory()->create(),
    //         ['*']
    //     );

    // }
}