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

        $response = $this->actingAs($user)->postJson('/api/workflowhistory', $workflowHistoryData);

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

        $response = $this->postJson('/api/workflowhistory', $workflowHistoryData);
        $response->assertStatus(401);

    }

    public function test_to_create_workflowhistory_controller_returns_validation_errors_for_invalid_data(): void
    {
        $user = User::factory()->create();

        $invalidData = [
            'user_id' => '',
            'task_id' => 'invalid',
        ];
        $response = $this->actingAs($user)->postJson('/api/workflowhistory', $invalidData);

        $response->assertJsonValidationErrors(['user_id', 'task_id']);
        $response->assertStatus(422);
    }

    public function test_fetch_all_workflow_histories(): void
    {
        WorkflowHistory::factory()->count(3)->create();
        $workflowHistoryService = new WorkflowHistoryService();
        $request = new Request();
        $workflowHistories = $workflowHistoryService->getWorkflowHistories($request);
        $this->assertInstanceOf(Collection::class, $workflowHistories);
        foreach ($workflowHistories as $workflowHistory) {
            $this->assertInstanceOf(WorkflowHistory::class, $workflowHistory);
        }
        $this->assertEquals(3, $workflowHistories->count());
   }

   public function test_index_method_returns_workflow_history_collection()
    {
        $mockService = $this->createMock(WorkflowHistoryService::class);
        $controller = new WorkflowHistoryController($mockService);
        $request = Request::create('/workflow-histories', 'GET');
        $response = $controller->index($request);
        $this->assertInstanceOf(WorkflowHistoryCollection::class, $response);
    }

}
