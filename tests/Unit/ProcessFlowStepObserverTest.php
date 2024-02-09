<?php

namespace Tests\Unit;

use App\Models\ProcessFlowStep;
use App\Observers\ProcessFlowStepObserver;
use App\Service\ProcessflowStepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessFlowStepObserverTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_to_see_if_we_can_update_the_nextstep_of_the_dependent_step(): void
    {
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

        $response = $this->actingAsTestUser()->postJson('/api/processflows', $processFlowData);

        $processFlowStepObserver = new ProcessFlowStepObserver((new ProcessflowStepService));
        $processFlowStepModel = ProcessFlowStep::where(["id" => 2])->first();
        $processFlowStepObserver->deleting($processFlowStepModel);
        // check if the update took place in the DB
        $this->assertDatabaseMissing("process_flow_steps", ["next_step_id" => 2]);

    }

    public function test_to_see_if_item_being_deleted_is_the_first_step(): void
    {
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

        $response = $this->actingAsTestUser()->postJson('/api/processflows', $processFlowData);

        $processFlowStepObserver = new ProcessFlowStepObserver((new ProcessflowStepService));
        $processFlowStepModel = ProcessFlowStep::where(["id" => 1])->first();
        $processFlowStepObserver->deleting($processFlowStepModel);
        // check if the update took place in the DB
        $this->assertDatabaseHas("process_flows", ["start_step_id" => 2]);

    }
}
