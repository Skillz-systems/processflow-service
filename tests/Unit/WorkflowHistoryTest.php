<?php

namespace Tests\Unit;

use App\Http\Controllers\WorkflowController;
use App\Models\WorkflowHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class WorkflowControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateWorkflowHistory()
    {
        // Arrange
        $requestData = [
            'user_id' => 1,
            'task_id' => 1,
            'step_id' => 1,
            'process_flow_id' => 1,
            'status' => 'done',
            // Add other required data
        ];

        // Mock the WorkflowHistory model
        $mockWorkflowHistory = Mockery::mock(WorkflowHistory::class);
        $mockWorkflowHistory->shouldReceive('save')->once();

        // Create an instance of the WorkflowController with the mocked model
        $workflowController = new WorkflowController($mockWorkflowHistory);

        // Act
        $result = $workflowController->createWorkflowHistory($requestData);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * Clean up Mockery expectations.
     */
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
