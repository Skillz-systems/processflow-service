<?php

namespace Tests\Unit;

use App\Http\Controllers\WorkflowController;
use App\Models\WorkflowHistory;
use App\Service\WorkflowHistoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class WorkflowHistoryTest extends TestCase
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
        $this->assertDatabaseHas('workflow_histories', [
            "user_id" => 1,
            "task_id" => 1,
            "step_id" => 1,
            "process_flow_id" => 1,
            "status" => 1,
        ]);

        $this->assertInstanceOf(WorkflowHistory::class, $createNewWorkflowHistory);

        $this->assertNotNull($createNewWorkflowHistory->id);
        $this->assertSame(1, $createNewWorkflowHistory->user_id);
        $this->assertSame(1, $createNewWorkflowHistory->task_id);
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

    public function test_to_see_if_a_workflowHistory_can_be_fetched(): void
    {

        $data = new Request([
            "user_id" => 1,
            "task_id" => 1,
            "step_id" => 1,
            "process_flow_id" => 1,
            "status" => 1,
        ]);

        $createNewWorkflowHistoryService = new WorkflowHistoryService();
        $result = $createNewWorkflowHistoryService->createWorkflowHistory($data);
        $fetchService = $createNewWorkflowHistoryService->getWorkflowHistory($result->id);
        $this->assertEquals($fetchService->id, $result->id);
        $this->assertInstanceOf(WorkflowHistory::class, $fetchService);

    }

    public function test_to_see_if_workflowHistory_returns_a_content(): void
    {
        $createNewWorkflowHistoryService = new WorkflowHistoryService();
        $fetchService = $createNewWorkflowHistoryService->getWorkflowHistory(1);

        $this->assertNull($fetchService);

    }
}
