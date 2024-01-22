<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Service\ProcessFlowService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\CreateProcessFlowServiceRequest;

class ProcessFlowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Creating a process flow with all required fields should return true.
    public function test_create_process_flow_with_all_required_fields()
    {
        // Arrange
        $request = new CreateProcessFlowServiceRequest([
            "name"          => "Process FLow 1",
            "start_step_id" => 1,
            "frequency"     => "daily",
            "frequency_for" => "users",
            "week"          => "weekly",
            "daily"         => "thursday",
        ]);

        $service = new ProcessFlowService();
        // Act
        $result = $service->createProcessFlow($request);

        // Assert
        $this->assertTrue($result);
    }


}
