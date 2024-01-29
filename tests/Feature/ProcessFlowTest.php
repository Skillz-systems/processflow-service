<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_create_new_process_flow_with_steps_controller(): void
    {
        $user = User::factory()->create();

        $processFlowData = [
            'name' => 'Test Process Flow',
            'frequency' => 'weekly',
            'status' => true,
            'frequency_for' => 'users',
            'day' => null,
            'week' => 'monday',
            'steps' => [
                [

                    'name' => 'test name single test',
                    'step_route' => 'this should be a route',
                    'assignee_user_route' => 1,
                    'next_user_designation' => 1,
                    'next_user_department' => 1,
                    'next_user_unit' => 1,
                    'next_user_location' => 1,
                    'step_type' => 'create',
                    'user_type' => 'customer',
                    'status' => 1,
                ],
                [

                    'name' => 'test name single two test',
                    'step_route' => 'this should be a route',
                    'assignee_user_route' => 1,
                    'next_user_designation' => 1,
                    'next_user_department' => 1,
                    'next_user_unit' => 1,
                    'next_user_location' => 1,
                    'step_type' => 'create',
                    'user_type' => 'customer',
                    'status' => 1,
                ],
            ],
        ];

        $response = $this->actingAs($user)->postJson('/api/processflows', $processFlowData);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'frequency',
                'status',
                'frequency_for',
                'day',
                'week',
                'steps' => [
                    '*' => [
                        'id',
                        'name',
                        'step_route',
                        'assignee_user_route',
                        'next_user_designation',
                        'next_user_department',
                        'next_user_unit',
                        'next_user_location',
                        'step_type',
                        'user_type',
                        'status',
                    ],
                ],
            ],
        ]);

        $this->assertDatabaseHas('process_flow_steps', [
            'name' => 'test name single two test',
        ]);
        $this->assertDatabaseHas('process_flows', ['name' => 'Test Process Flow'], );
        $response->assertStatus(201);

    }
    public function test_to_create_new_process_flow_without_steps_controller(): void
    {
        $user = User::factory()->create();

        $processFlowData = [
            'name' => 'Test Process Flow',
            'start_step_id' => 3,
            'frequency' => 'weekly',
            'status' => true,
            'frequency_for' => 'users',
            'day' => null,
            'week' => 'monday',
        ];

        $response = $this->actingAs($user)->postJson('/api/processflows', $processFlowData);

        $this->assertDatabaseHas('process_flows', $processFlowData);
        $response->assertStatus(201);

    }
    public function test_to_failed_when_unautheticated_try_to_access_process_flow_route(): void
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
        $response->assertStatus(401);

    }

    public function test_to_create_process_flow_controller_returns_validation_errors_for_invalid_data(): void
    {
        $user = User::factory()->create();

        $invalidData = [
            'name' => '',
            'frequency' => 'invalid',
        ];
        $response = $this->actingAs($user)->postJson('/api/processflows', $invalidData);

        $response->assertJsonValidationErrors(['name', 'frequency']);
        $response->assertStatus(422);
    }

    public function test_to_view_process_flow_with_valid_id_successfully(): void
    {
        $user = User::factory()->create();

        $processFlowData = [
            'name' => 'Test Process Flow',
            'frequency' => 'weekly',
            'status' => true,
            'frequency_for' => 'users',
            'day' => null,
            'week' => 'monday',
            'steps' => [
                [

                    'name' => 'test name single test',
                    'step_route' => 'this should be a route',
                    'assignee_user_route' => 1,
                    'next_user_designation' => 1,
                    'next_user_department' => 1,
                    'next_user_unit' => 1,
                    'next_user_location' => 1,
                    'step_type' => 'create',
                    'user_type' => 'customer',
                    'status' => 1,
                ],
                [

                    'name' => 'test name single two test',
                    'step_route' => 'this should be a route',
                    'assignee_user_route' => 1,
                    'next_user_designation' => 1,
                    'next_user_department' => 1,
                    'next_user_unit' => 1,
                    'next_user_location' => 1,
                    'step_type' => 'create',
                    'user_type' => 'customer',
                    'status' => 1,
                ],
            ],
        ];
        $response = $this->actingAs($user)->postJson('/api/processflows', $processFlowData);
        $response->assertStatus(201);

        $processFlowId = $response->json('data.id');
        $this->actingAs($user)->getJson('/api/processflows/' . $processFlowId)->assertStatus(200)->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'frequency',
                'status',
                'frequency_for',
                'day',
                'week',
                'steps' => [
                    '*' => [
                        'id',
                        'name',
                        'step_route',
                        'assignee_user_route',
                        'next_user_designation',
                        'next_user_department',
                        'next_user_unit',
                        'next_user_location',
                        'step_type',
                        'user_type',
                        'status',
                    ],
                ],
            ],
        ]);

    }
    public function test_to_return_error_when_trying_to_view_none_existent_process_flow(): void
    {
        $user = User::factory()->create();
        $id = 9999;

        $response = $this->actingAs($user)->getJson('/api/processflows' . $id);
        $response->assertJsonValidationErrors(['id']);
        $response->assertStatus(422);

    }
    public function test_to_verify_only_logged_in_users_can_view_a_process_flow(): void
    {
        $user = User::factory()->create();

        $processFlowData = [
            'name' => 'Test Process Flow',
            'start_step_id' => 3,
            'frequency' => 'weekly',
            'status' => true,
            'frequency_for' => 'users',
            'day' => null,
            'week' => 'monday',
        ];
        $response = $this->actingAs($user)->postJson('/api/processflows', $processFlowData);
        $response->assertStatus(201);
        $this->getJson('/api/processflows' . $response->json('data.id'))->assertStatus(401);

    }

}
