<?php

namespace Tests\Unit;

use App\Models\Routes;
use App\Service\RouteService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

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

}
