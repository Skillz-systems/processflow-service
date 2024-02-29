<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Routes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_that_a_route_can_be_created(): void
    {
        $data = [
            "name" => "home",
            "link" => "http://routename.com/home",
            "status" => 1,
        ];

        $result = $this->actingAsTestUser()->postJson("/api/route/create", $data);
        $this->assertDatabaseHas("routes", $data);
        $result->assertStatus(201)->assertJson([
            "data" => [
                "name" => "home",
                "link" => "http://routename.com/home",
                "status" => 1,
            ],
        ]);
    }

    public function test_that_validation_works_when_a_route_is_created()
    {
        $data = [
            "name" => "home",
            "link" => "http://routename.com/home",
        ];

        $result = $this->actingAsTestUser()->postJson("/api/route/create", $data);
        $this->assertDatabaseMissing("routes", $data);
        $this->assertArrayHasKey('status', $result);
        $result->assertStatus(400);
    }

    public function test_that_all_Active_routes_can_be_fetched()
    {
        Routes::factory(6)->create();
        $result = $this->actingAsTestUser()->getJson("/api/route");
        $result->assertOk()->assertJsonStructure([
            "data" => [
                [
                    "name",
                    "link",
                    "status",
                ],

            ],
        ]);
        $this->assertEquals(6, count($result["data"]));
    }

    public function test_to_see_if_fetched_records_would_ignore_inactive_routes()
    {

        Routes::factory(3)->create();
        Routes::factory(3)->create(["status" => false]);

        $result = $this->actingAsTestUser()->getJson("/api/route");
        $result->assertOk()->assertJsonStructure([
            "data" => [
                [
                    "name",
                    "link",
                    "status",
                ],

            ],
        ]);
        $this->assertEquals(3, count($result["data"]));
    }

    public function test_to_see_no_item_is_returned_when_there_is_no_active_record()
    {
        Routes::factory(3)->create(["status" => false]);

        $result = $this->actingAsTestUser()->getJson("/api/route");
        $result->assertOk()->assertJsonStructure([
            "data",
        ]);
        $this->assertEquals(0, count($result["data"]));
    }

    public function test_to_see_if_view_route_can_fetch_a_single_route()
    {
        Routes::factory(3)->create();
        $result = $this->actingAsTestUser()->getJson("/api/route/view/1");
        $result->assertOk()->assertJsonStructure([
            "data" => [
                "name",
                "link",
                "status"
            ]
        ]);
    }

    public function test_to_see_if_an_exception_would_be_thrown_when_a_wrong_id_is_provided_for_route()
    {
        $result = $this->actingAsTestUser()->getJson("/api/route/view/1");
        $result->assertStatus(404)->assertJson(['message' => 'No query results for model [App\\Models\\Routes] 1']);
    }
}
