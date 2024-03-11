<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Resources\WorkflowHistoryCollection;
use App\Models\WorkflowHistory;
use App\Service\WorkflowHistoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\WorkflowController;
use Illuminate\Support\Collection;
use App\Http\Controllers\WorkflowHistoryController;

class WorkflowHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_create_new_workflowhistory_controller(): void
    {
        $user = User::factory()->create();

        $workflowHistoryData = [
            'user_id' => 1,
            'task_id' => 1,
            'step_id' => 1,
            'process_flow_id' => 1,
            'status' => 1,
        ];

        $response = $this->actingAs($user)->postJson('/api/workflowhistory/create', $workflowHistoryData);

        $this->assertDatabaseHas('workflow_histories', $workflowHistoryData);
        $response->assertStatus(201);
    }
    public function test_to_failed_when_unautheticated_try_to_access_workflowhistory_route(): void
    {

        $workflowHistoryData = [
            'user_id' => 1,
            'task_id' => 1,
            'step_id' => 1,
            'process_flow_id' => 1,
            'status' => true,
        ];

        $response = $this->postJson('/api/workflowhistory/create', $workflowHistoryData);
        $response->assertStatus(401);
    }

    public function test_create_workflowhistory_controller_returns_validation_errors_for_invalid_data(): void
{
    $user = User::factory()->create();
    $invalidData = [];
    $response = $this->actingAs($user)->postJson('/api/workflowhistory/create', $invalidData);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['user_id', 'task_id']);
    $response->assertJsonStructure([
        'message',
        'errors' => [
            'user_id',
            'task_id',
            'step_id',
            'process_flow_id',
            'status',
        ],
    ]);
}
    public function test_if_all_workflow_can_be_fetched()
    {
        WorkflowHistory::factory(3)->create(["status" => 1]);
        $response =  $this->actingAsTestUser()->getJson("/api/workflowhistory");
        $response->assertOk()->assertJsonStructure(
            [
                "data" => [[

                    "task_id",
                    "step_id",
                    "process_flow_id",
                    "user_id",
                    "status",
                ]
                    
                ]
            ]
        );
    }


    public function test_to_update_process_flow_without_steps_successfully(): void
    {
        $processFlowData = ProcessFlow::factory()->create();
        $processFlowId = $processFlowData->id;
        $data = [
            'name' => 'Updated Process Flow Name',
        ];

        $this->actingAsTestUser()->putJson('/api/processflows/' . $processFlowId, $data)->assertStatus(200);
        $this->assertDatabaseHas('process_flows', $data);

    }
    public function test_to_unauthorized_cannot_update_process_flow_(): void
    {
        $processFlowData = ProcessFlow::factory()->create();
        $processFlowId = $processFlowData->id;
        $data = [
            'name' => 'Updated Process Flow Name',
        ];

        $this->putJson('/api/processflows/' . $processFlowId, $data)->assertStatus(401);

    }

    public function test_to_return_error_when_trying_to_update_nonexistent_process_flow(): void
    {

        $id = 9999;
        $data = [
            'name' => 'Updated Process Flow Name',
        ];

        $response = $this->actingAsTestUser()->putJson('/api/processflows/' . $id, $data);
        $response->assertStatus(404);
    }

}
