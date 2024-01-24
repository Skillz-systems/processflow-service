<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Models\ProcessFlowStep;
use App\Service\ProcessflowStepService;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function test_to_get_a_processflow_step_with_id(): void
    {
        $data    = new Request([
            "name"                  => "test name single",
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


        $getStep = $service->getProcessFlowStep($result->id);
        $this->assertDatabaseCount('process_flow_steps', 1);
        $this->assertInstanceOf(ProcessFlowStep::class, $result);
        $this->assertEquals($getStep->id, $result->id);


    }

    public function test_to_returns_null_if_not_found_or_invalid_id_for_processflow_step(): void
    {

        $service   = new ProcessFlowStepService();
        $foundStep = $service->getProcessFlowStep(999);
        $this->assertNull($foundStep);
    }

    public function test_to_update_a_processflow_step(): void
    {
        // $data    = new Request([
        //     "name"                  => "test name single",
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

        $mock    = ProcessFlowStep::factory()->make();
        $service = new ProcessflowStepService();
        $create  = $service->createProcessFlowStep(new Request($mock->toArray()));
        $update  = $service->updateProcessFlowStep(new Request(["name" => "test name updated",]), $create->id);


        $this->assertDatabaseHas('process_flow_steps', [
            "name" => "test name updated",
        ]);
        $this->assertInstanceOf(ProcessFlowStep::class, $update);

    }

    public function test_to_see_an_error_happens_when_updating_a_processflow_step(): void
    {

        $mock    = ProcessFlowStep::factory()->make();
        $service = new ProcessflowStepService();
        $created = $service->createProcessFlowStep(new Request($mock->toArray()));
        $service = new ProcessFlowStepService();
        $result  = $service->updateProcessFlowStep(new Request(["name" => ""]), 99);
        $this->assertNull($result);
        // $this->assertIsArray($result);
        // $this->assertArrayHasKey('name', $result);

    }


}
