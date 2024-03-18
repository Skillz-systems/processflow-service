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

    // Test that the authenticated route to get all designations returns the correct data format
    // public function test_route_authenticated_to_get_all_designations_returnsCorrectDataFormat(): void
    // {
    //     $designations = Designation::factory(20)->create();

    //     $response = $this->actingAsTestUser()->getJson('/api/designations');

    //     $response->assertJsonStructure(
    //         [
    //             '*' => [
    //                 'id',
    //                 'name',
    //                 'created_at',
    //                 'updated_at',
    //             ],
    //         ]
    //     );
    // }



    public function test_route_authenticated_to_get_single_designation(): void
    {
        $designation = Designation::factory()->create();
        $response = $this->actingAsTestUser()->getJson('/api/designations/' . $designation->id);
        $response->assertStatus(200);
    }


    public function test_route_unauthenticated_cannot_get_single_designation(): void
    {
        Designation::factory(1)->create();
        $this->getJson('/api/designations/1')->assertStatus(401);
    }

    // Test getting non-existent designation returns 404
    public function test_route_non_existing_designation_get_throws_non_found(): void
    {
        $this->actingAsTestUser()->getJson('/api/designations/999')->assertStatus(404);
    }
}
