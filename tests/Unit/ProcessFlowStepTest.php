<?php

namespace Tests\Unit;

use App\Models\ProcessFlowStep;
use App\Service\ProcessflowStepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ProcessFlowStepTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */

    public function test_to_see_if_the_processfolow_was_created(): void
    {
        $data                            = new Request([
            "name"                  => "test name",
            "step_route"            => "this should be a route",
            "assignee_user_route"   => 1,
            "next_user_designation" => 1,
            "next_user_department"  => 1,
            "next_user_unit"        => 1,
            "process_flow_id"       => 1,
            "next_user_location"    => 1,
            "step_type"             => "create",
            "user_type"             => "customer",
            "next_step_id"          => 2,
            "status"                => 1,
        ]);
        $createNewProcessFlowStepService = new ProcessflowStepService();
        $createNewProcessFlowStep        = $createNewProcessFlowStepService->createProcessFlowStep($data);
        $this->assertDatabaseHas('process_flow_steps', [
            "name"                  => "test name",
            "step_route"            => "this should be a route",
            "assignee_user_route"   => 1,
            "next_user_designation" => 1,
            "next_user_department"  => 1,
            "next_user_unit"        => 1,
            "process_flow_id"       => 1,
            "next_user_location"    => 1,
            "step_type"             => "create",
            "user_type"             => "customer",
            "next_step_id"          => 2,
            "status"                => 1,
        ]);

        $this->assertInstanceOf(ProcessFlowStep::class, $createNewProcessFlowStep);

        $this->assertNotNull($createNewProcessFlowStep->id);
        $this->assertSame('test name', $createNewProcessFlowStep->name);
        $this->assertSame('this should be a route', $createNewProcessFlowStep->step_route);

        //$this->assertTrue($createNewProcessFlowStep);

    }

    public function test_to_see_if_an_error_happens_when_creating_a_processfolow(): void
    {
        $data                            = new Request([
            "name" => "test name 2",
        ]);
        $createNewProcessFlowStepService = new ProcessflowStepService();
        $createNewProcessFlowStep        = $createNewProcessFlowStepService->createProcessFlowStep($data);
        $resultArray                     = $createNewProcessFlowStep->toArray();
        $this->assertNotEmpty($createNewProcessFlowStep);
        $this->assertIsArray($resultArray);
        $this->assertArrayHasKey('step_route', $resultArray);
        $this->assertArrayHasKey('step_type', $resultArray);

    }

    public function test_to_see_if_processflow_step_can_be_viewed(): void
    {
        $data    = new Request([
            "name"                  => "test name",
            "step_route"            => "this should be a route",
            "assignee_user_route"   => 1,
            "next_user_designation" => 1,
            "next_user_department"  => 1,
            "next_user_unit"        => 1,
            "process_flow_id"       => 1,
            "next_user_location"    => 1,
            "step_type"             => "create",
            "user_type"             => "customer",
            "next_step_id"          => 2,
            "status"                => 1,
        ]);
        $service = new ProcessflowStepService();

        $result = $service->createProcessFlowStep($data);


        $viewStepService = $service->viewProcessFlowStep($result->id);
        $this->assertDatabaseCount('process_flow_steps', 1);
        $this->assertInstanceOf(ProcessFlowStep::class, $result);
        $this->assertEquals(1, $result->id);


    }
    public function test_error_when_invalid_Id_or_error_result(): void
    {
        // Non-existent ID
        $invalidId = 999;

        // Retrieve by invalid ID
        $service = new ProcessFlowStepService();
        $result  = $service->viewProcessFlowStep($invalidId);

        // Assertions
        $this->assertNull($result);
        $this->assertArrayHasKey('message', $result->errors->toArray());
    }
}
