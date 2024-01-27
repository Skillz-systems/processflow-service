<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_create_a_new_process_flow_in_controller():void
    {

        $processFlowData = [
            'name' => 'Test Process Flow',
            'start_step_id' => 3,
            'frequency' => 'weekly',
            'status' => true,
            'frequency_for' => 'users',
            'day' => null,
            'week' => 'monday',
        ];

        $response = $this->postJson('/api/processflows', $processFlowData);

        $this->assertDatabaseHas('process_flows', $processFlowData);
        $response->assertStatus(201);

    }

    public function test_to_create_process_flow_controller_returns_validation_errors_for_invalid_data():void
    {
        $invalidData = [
            'name' => '',
            'frequency' => 'invalid',
        ];
        $response = $this->postJson('/api/processflows', $invalidData);

        $response->assertJsonValidationErrors(['name', 'frequency']);
        $response->assertStatus(422);
    }
}
