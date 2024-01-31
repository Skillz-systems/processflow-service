<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ProcessFlow;
use App\Models\ProcessFlowStep;
use App\Service\ProcessFlowService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessflowStepControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */

    // test to see if the process flow exist
    // test to see if the process flow has a defaul start step already
    //tess data validations
    // test that a new step can be created
    // test that processflow start step can be updated (note : only if it has not been previously set)
    // test to see if created steps can update its next xtep column

    public function test_to_see_if_processflow_step_can_be_created_and_update_start_step_id_with_the_first_created_step(): void
    {
        // super user

        // create two processflow
        $data = ["steps" =>
            [

                [
                    "name" => "test name",
                    "step_route" => "this should be a route",
                    "assignee_user_route" => 1,
                    "next_user_designation" => 1,
                    "next_user_department" => 1,
                    "next_user_unit" => 1,
                    "process_flow_id" => 1,
                    "next_user_location" => 1,
                    "step_type" => "create",
                    "user_type" => "customer",
                    "status" => 1,
                ],
                [
                    "name" => "test name 2",
                    "step_route" => "this should be a route 2",
                    "assignee_user_route" => 1,
                    "next_user_designation" => 1,
                    "next_user_department" => 1,
                    "next_user_unit" => 1,
                    "process_flow_id" => 1,
                    "next_user_location" => 1,
                    "step_type" => "create",
                    "user_type" => "customer",
                    "status" => 1,
                ],
            ],
        ];

        $this->createProcessflow(2);
        $response = $this->actingAsTestUser()->postJson('api/processflowstep/create/1', $data);
        $this->assertDatabaseCount("process_flows", 2);
        $this->assertDatabaseCount("process_flow_steps", 2);
        $this->assertDatabaseHas("process_flow_steps", [
            "name" => "test name",
            "step_route" => "this should be a route",
            "assignee_user_route" => 1,
            "next_user_designation" => 1,
            "next_user_department" => 1,
            "next_user_unit" => 1,
            "process_flow_id" => 1,
            "next_user_location" => 1,
            "step_type" => "create",
            "user_type" => "customer",
            "status" => 1,
        ], );
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

        //$response->assertJsonStructure();
        $response->assertStatus(200);
    }

    public function tests_to_see_if_processflow_does_not_exist()
    {
        $data = ["steps" =>
            [

                [
                    "name" => "test name",
                    "step_route" => "this should be a route",
                    "assignee_user_route" => 1,
                    "next_user_designation" => 1,
                    "next_user_department" => 1,
                    "next_user_unit" => 1,
                    "process_flow_id" => 1,
                    "next_user_location" => 1,
                    "step_type" => "create",
                    "user_type" => "customer",
                    "status" => 1,
                ],

            ],
        ];

        $response = $this->actingAsTestUser()->postJson('api/processflowstep/create/1', $data);
        $response->assertStatus(404);
    }

    public function test_toSee_if_we_can_create_a_new_process_flow_steps_for_a_process_flow_that_already_has_a_start_step_id()
    {

        $data = ["steps" =>
            [

                [
                    "name" => "test name",
                    "step_route" => "this should be a route",
                    "assignee_user_route" => 1,
                    "next_user_designation" => 1,
                    "next_user_department" => 1,
                    "next_user_unit" => 1,
                    "process_flow_id" => 1,
                    "next_user_location" => 1,
                    "step_type" => "create",
                    "user_type" => "customer",
                    "status" => 1,
                ],
                [
                    "name" => "test name 2",
                    "step_route" => "this should be a route 2",
                    "assignee_user_route" => 1,
                    "next_user_designation" => 1,
                    "next_user_department" => 1,
                    "next_user_unit" => 1,
                    "process_flow_id" => 1,
                    "next_user_location" => 1,
                    "step_type" => "create",
                    "user_type" => "customer",
                    "status" => 1,
                ],
            ],
        ];

        $this->createProcessflow(1, true);

        ProcessFlowStep::factory()->create(["process_flow_id" => 1]);
        $response = $this->actingAsTestUser()->postJson('api/processflowstep/create/1', $data);

        $this->assertDatabaseCount("process_flows", 1);
        $this->assertDatabaseCount("process_flow_steps", 3);
        $this->assertDatabaseHas("process_flow_steps", [

            "next_step_id" => 2,
        ], );
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
        $getProcessFlow = (new ProcessFlowService())->getProcessFlow(1);
        $this->assertEquals($getProcessFlow->start_step_id, 8);
        $response->assertStatus(200);

    }

    public function test_toSee_if_we_can_create_a_new_process_flow_steps_for_a_process_flow_that_already_has_a_start_step_id_and_new_step_is_not_more_than_1()
    {

        $data = ["steps" =>
            [

                [
                    "name" => "test name",
                    "step_route" => "this should be a route",
                    "assignee_user_route" => 1,
                    "next_user_designation" => 1,
                    "next_user_department" => 1,
                    "next_user_unit" => 1,
                    "process_flow_id" => 1,
                    "next_user_location" => 1,
                    "step_type" => "create",
                    "user_type" => "customer",
                    "status" => 1,
                ],

            ],
        ];

        $this->createProcessflow(1, true);

        ProcessFlowStep::factory()->create(["process_flow_id" => 1]);
        $response = $this->actingAsTestUser()->postJson('api/processflowstep/create/1', $data);

        $this->assertDatabaseCount("process_flows", 1);
        $this->assertDatabaseCount("process_flow_steps", 2);
        $this->assertDatabaseHas("process_flow_steps", [

            "next_step_id" => 2,
        ], );
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
        $getProcessFlow = (new ProcessFlowService())->getProcessFlow(1);
        $this->assertEquals($getProcessFlow->start_step_id, 8);
        $response->assertStatus(200);

    }

    private function createProcessflow(int $quantity = 1, $withStartStep = false): void
    {
        if (!$withStartStep) {
            ProcessFlow::factory($quantity)->create();

        } else {

            ProcessFlow::factory($quantity)->create(["start_step_id" => 8]);

        }

    }
}