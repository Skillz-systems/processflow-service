<?php

namespace Tests\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mockery;
use Mockery\MockInterface;
use Skillz\UserService;

class ScopeUserTestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Mock the UserService class
        $userService = Mockery::mock(UserService::class);

        // Set the expected behavior of the getRequest() method
        $userService->shouldReceive('getRequest')
            ->with('get', 'scope/user')
            ->once()
            ->andReturn(
                Mockery::mock(\Illuminate\Http\Client\Response::class, function (MockInterface $mock) {
                    $mock->shouldReceive('ok')->andReturn(true);
                    $mock->shouldReceive('json')->andReturn(['scope' => 'authorized']);
                })
            );

        // Simulate the authorized user scenario
        $response = $userService->getRequest('get', 'scope/user');
        if ($response->ok()) {
            // The user is authorized, so allow the request to proceed
            return $next($request);
        } else {
            // The user is not authorized, so return a 401 Unauthorized response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}