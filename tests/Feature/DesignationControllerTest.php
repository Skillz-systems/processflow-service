<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Designation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DesignationControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_route_authenticated_to_get_all_designations(): void
    {

        $designations = Designation::factory(20)->create();

        $response = $this->actingAsTestUser()->getJson('/api/designations/');

        $this->assertCount(20, $designations);
        $response->assertStatus(200);
    }
    public function test_route_unauthenticated_cannot_get_all_designations(): void
    {

        Designation::factory(10)->create();
        $this->getJson('/api/designations')->assertStatus(401);
    }
}
