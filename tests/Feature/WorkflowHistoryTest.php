<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ProcessFlow;
use Illuminate\Http\Request;
use App\Models\WorkflowHistory;
use Illuminate\Support\Collection;
use App\Service\WorkflowHistoryService;
use App\Http\Controllers\WorkflowController;
use App\Http\Resources\WorkflowHistoryCollection;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response = $this->actingAsTestUser()->getJson("/api/workflowhistory");
        $response->assertOk()->assertJsonStructure(
            [
                "data" => [
                    [

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


    public function test_it_can_get_a_single_workflowhistory(): void
    {
        $workflowhistory = WorkflowHistory::factory()->create();

        $response = $this->actingAsTestUser()->getJson('/api/workflowhistory/'.$workflowhistory->id);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'task_id' => $workflowhistory->task_id,
                'step_id' => $workflowhistory->step_id,
                'process_flow_id' => $workflowhistory->process_flow_id,
                'user_id' => $workflowhistory->user_id,
                'status' => $workflowhistory->status
            ],
        ]);
    }

    public function test_it_returns_404_when_getting_a_non_existent_workflowhistory(): void
    {
    $response = $this->actingAsTestUser()->getJson('/api/workflowhistory/9999');
    $response->assertNotFound();

    }

    public function test_it_returns_401_unauthenticated_for_non_logged_users(): void
    {
        $workflowHistory = WorkflowHistory::factory()->create();
        $response = $this->getJson('/api/workflowhistory/'.$workflowHistory->id)->assertStatus(401);
    }



    public function test_to_delete_a_workflowhistory(): void
    { $workflowHistory = WorkflowHistory::factory()->create();

        $response = $this->actingAsTestUser()->deleteJson('/api/workflowhistory/'. $workflowHistory->id);
        $response->assertStatus(204);
    }


    public function test_to_unauthorized_cannot_delete_a_workflowhistory(): void
    {
        $workflowHistory = WorkflowHistory::factory()->create();
        $response = $this->deleteJson('/api/workflowhistory/' . $workflowHistory->id);
        $response->assertStatus(401);
    }
}
