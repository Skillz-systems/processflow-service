<?php

namespace Tests\Unit;

use App\Models\Routes;
use App\Service\RouteService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test to see if a route can be created
     */
    public function test_to_see_if_a_route_can_be_created(): void
    {
        $data = new Request([
            "name" => "home",
            "link" => "http://routename.com/home",
            "status" => 1,
        ]);
        $routeService = (new RouteService())->createRoute($data);
        $this->assertDatabaseHas("routes", $data->all());
        $this->assertInstanceOf(Routes::class, $routeService);
    }

    public function test_to_ensure_all_required_fields_are_validated()
    {
        $data = new Request([
            "name" => "home",
            "status" => 1,
        ]);
        $routeService = (new RouteService())->createRoute($data);
        $this->assertDatabaseMissing("routes", $data->all());
        $this->assertArrayHasKey('link', $routeService->toArray());
    }

    public function test_to_see_if_all_routes_can_be_fetched()
    {
        Routes::factory(5)->create();
        $routeService = (new RouteService())->getAllRoute();
        $this->assertInstanceOf(Routes::class, $routeService[0]);
        $this->assertEquals(5, count($routeService->toArray()));
    }

    public function test_only_routes_with_status_true_can_be_fetched()
    {
        Routes::factory(5)->create(["status" => false]);
        $routeService = (new RouteService())->getAllRoute();
        $this->assertEquals(0, count($routeService->toArray()));
    }

    public function test_to_see_if_a_single_route_can_be_fetched()
    {
        Routes::factory(5)->create();
        $routeService = (new RouteService())->getRoute(1);
        $this->assertArrayHasKey("id", $routeService);
        $this->assertArrayHasKey("link", $routeService);
        $this->assertArrayHasKey("name", $routeService);
        $this->assertInstanceOf(Routes::class, $routeService);
    }

    public function test_to_see_if_the_id_is_wrong()
    {
        try {
            (new RouteService())->getRoute(0);
        } catch (ModelNotFoundException $e) {
            // Assert
            $this->assertInstanceOf(ModelNotFoundException::class, $e);
        }
    }
}
