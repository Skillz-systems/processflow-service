<?php

namespace Tests\Unit\Queue;


use Tests\TestCase;
use App\Models\Routes;
use App\Jobs\Route\RouteCreated;
use App\Jobs\Route\RouteDeleted;
use App\Jobs\Route\RouteUpdated;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteQueueTest extends TestCase
{

   use RefreshDatabase;

 public function test_it_dispatches_the_route_created_job()
    {
        Queue::fake();
        $route = Routes::factory()->create();
        RouteCreated::dispatch($route->toArray());
        Queue::assertPushed(RouteCreated::class, function ($job) use ($route) {
            return $job->getData() == $route->toArray();
        });
    }

public function test_it_dispatches_the_route_updated_job()
    {
        Queue::fake();
        $route = Routes::factory()->create();

        RouteUpdated::dispatch($route->toArray());
        Queue::assertPushed(RouteUpdated::class, function ($job) use ($route) {
            return $job->getData() == $route->toArray();
        });
    }

    public function test_it_handles_route_deleted_job(): void
    {

        Queue::fake();
        $route = Routes::factory()->create();
        RouteDeleted::dispatch($route->id);
        Queue::assertPushed(RouteDeleted::class, function ($job) use ($route) {
            return $job->getId() == $route->id;
        });
    }
}
