<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\CreatesApplication;
use PHPUnit\Framework\TestCase;
use App\Service\ProcessFlowService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\CreateProcessFlowServiceRequest;

class ProcessFlowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    use CreatesApplication;

    // Creating a process flow with all required fields should return true.
    public function test_create_process_flow_with_all_required_fields()
    {
        $data = [
            "name"          => "Process FLow 1",
            "start_step_id" => 1,
            "frequency"     => "daily",
            "frequency_for" => "users",
            "week"          => "weekly",
            "daily"         => "thursday",
        ];

        $request = new CreateProcessFlowServiceRequest($data);

        $service = new ProcessFlowService();
        // Act
        $result = $service->createProcessFlow($request);
        // Assert
        $this->assertTrue($result);









        // $createNewProcessFlowStepService = new ProcessflowStepService();
        // $createNewProcessFlowStep        = $createNewProcessFlowStepService->createProcessFlowStep($data);
        // $this->assertDatabaseHas('process_flow_steps', [
        //     "name"                  => "test name",
        //     "step_route"            => "this should be a route",
        //     "assignee_user_route"   => 1,
        //     "next_user_designation" => 1,
        //     "next_user_department"  => 1,
        //     "next_user_unit"        => 1,
        //     "process_flow_id"       => 1,
        //     "next_user_location"    => 1,
        //     "step_type"             => "create",
        //     "user_type"             => "customer",
        //     "next_step_id"          => 2,
        //     "status"                => 1,
        // ]);
        // $this->assertTrue($createNewProcessFlowStep);
    }


}
