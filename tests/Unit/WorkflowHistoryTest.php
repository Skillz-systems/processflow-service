<?php

namespace Tests\Unit;

use App\Http\Controllers\WorkflowController;
use App\Models\WorkflowHistory;
use App\Service\WorkflowHistoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class WorkflowControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_to_see_if_the_workflowhistory_was_created(): void
    {
        $data = new Request([
            "user_id" => 1,
            "task_id" => 1,
            "step_id" => 1,
            "process_flow_id" => 1,
            "status" => 1,
        ]);
        $createNewWorkflowHistoryService = new WorkflowHistoryService();
        $createNewWorkflowHistory = $createNewWorkflowHistoryService->createWorkflowHistory($data);
        $this->assertDatabaseHas('work_flow_history', [
            "user_id" => 1,
            "task_id" => 1,
            "step_id" => 1,
            "process_flow_id" => 1,
            "status" => 1,
        ]);

        $this->assertInstanceOf(WorkflowHistory::class, $createNewWorkflowHistory);

        $this->assertNotNull($createNewWorkflowHistory->id);
        $this->assertSame('user id', $createNewWorkflowHistory->user_id);
        $this->assertSame('task id', $createNewWorkflowHistory->task_id);
    }

    public function test_to_see_if_an_error_happens_when_creating_a_workflowHistory(): void
    {
        $data = new Request([
            "user" => 1,
        ]);
        $createNewWorkflowHistoryService = new WorkflowHistoryService();
        $createNewWorkflowHistory = $createNewWorkflowHistoryService->createWorkflowHistory($data);
        $resultArray = $createNewWorkflowHistory->toArray();
        $this->assertNotEmpty($createNewWorkflowHistory);
        $this->assertIsArray($resultArray);
    }
}
