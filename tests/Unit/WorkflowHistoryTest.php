<?php

namespace Tests\Unit;
use App\Models\WorkflowHistory;
use App\Service\WorkflowHistoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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

   public function test_to_see_if_an_error_happens_when_creating_a_workflowhistory(): void
    {
        $data = new Request([
            "user_id" => 1,
            "step_id" => 1,
            "process_flow_id" => 1,
            "status" => 1,
        ]);
        $createNewWorkflowHistoryService = new WorkflowHistoryService();
        $createNewWorkflowHistory = $createNewWorkflowHistoryService->createWorkflowHistory($data);
        $resultArray = $createNewWorkflowHistory->toArray();
        $this->assertNotEmpty($createNewWorkflowHistory);
        $this->assertIsArray($resultArray);
        $this->assertArrayHasKey('task_id', $resultArray);
    }

    public function test_to_see_if_a_workflowhistory_can_be_fetched(): void
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

    public function test_to_see_if_workflowhistory_returns_a_content(): void
    {
        $createNewWorkflowHistoryService = new WorkflowHistoryService();
        $fetchService = $createNewWorkflowHistoryService->getWorkflowHistory(1);

        $this->assertNull($fetchService);

    }

    public function test_to_update_a_workflowhistory_successfully(): void
    {

        $create  = WorkflowHistory::factory()->create();
        $service = new WorkflowHistoryService();
        $update  = $service->updateWorkflowHistory(new Request(["status" => 1,]), $create->id);


        $this->assertDatabaseHas('workflow_histories', [
            "status" => 1,
        ]);
        $this->assertInstanceOf(WorkflowHistory::class, $update);

    }

    public function test_to_update_throws_exception_workflowhistory_for_error(): void
    {
        $this->expectException(\Exception::class);
        $request = new Request([
            'status' => 1,
        ]);
        $id      = 0;
        $service = new WorkflowHistoryService();

        $service->updateWorkflowHistory($request, $id);
        $this->expectException(ModelNotFoundException::class);
    }

    public function test_to_if_a_workflowhistory_can_be_deleted()
    {
        $data = new Request([
            "user_id" => 1,
            "task_id" => 1,
            "step_id" => 1,
            "process_flow_id" => 1,
            "status" => 1,
        ]);

        $createNewWorkflowHistoryService = new WorkflowHistoryService();
        $data = $createNewWorkflowHistoryService->createWorkflowHistory($data);
        $this->assertDatabaseCount("workflow_histories", 1);
        $delete = $createNewWorkflowHistoryService->deleteWorkflowHistory($data->id);
        $this->assertDatabaseMissing("workflow_histories", ["task_id" => 1]);
        $this->assertTrue($delete);

    }

    public function test_to_see_if_there_is_no_record_with_the_provided_id()
    {
        $createNewWorkflowHistoryService = new WorkflowHistoryService();
        $delete = $createNewWorkflowHistoryService->deleteWorkflowHistory(1);
        $this->assertFalse($delete);

    }

    public function test_fetch_all_workflow_histories(): void
    {
        WorkflowHistory::factory(3)->create(["status" => 1]);
        $workflowHistoryService = new WorkflowHistoryService();
        $workflowHistories = $workflowHistoryService->getWorkflowHistories();
        $this->assertInstanceOf(Collection::class, $workflowHistories);
        foreach ($workflowHistories as $workflowHistory) {
            $this->assertInstanceOf(WorkflowHistory::class, $workflowHistory);
        }
        
        $this->assertEquals(3, count($workflowHistories->toArray()));
   }

}
