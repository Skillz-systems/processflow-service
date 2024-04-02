<?php

namespace Tests\Feature;

use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_a_single_unit(): void
    {
        $unit = Unit::factory()->create();

        $response = $this->actingAsTestUser()->getJson('/api/units/'.$unit->id);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $unit->id,
                'name' => $unit->name,
                'created_at' => $unit->created_at->toISOString(), // Convert Carbon instance to ISO string
                'updated_at' => $unit->updated_at->toISOString(), // Convert Carbon instance to ISO string
            ],
        ]);
    }

    public function test_it_returns_404_when_getting_a_non_existent_unit(): void
    {
        $response = $this->actingAsTestUser()->getJson('/api/units/9999');
        $response->assertNotFound();
    }

    public function test_it_returns_401_unauthenticated_for_non_logged_users(): void
    {
        $unit = Unit::factory()->create();
        $response = $this->getJson('/api/units/'.$unit->id)->assertStatus(401);
    }


     public function test_it_can_get_all_units(): void
    {
        Unit::factory()->count(5)->create();

        $response = $this->actingAsTestUser()->getJson('/api/units');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_it_returns_401_unauthenticated_to_get_all_units(): void
    {
        Unit::factory()->count(3)->create();
        $this->getJson('/api/units/')->assertStatus(401);
    }


}
