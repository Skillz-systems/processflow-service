<?php

namespace Tests\Unit;

use App\Service\ProcessStepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class StepTest extends TestCase
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
        $createNewProcessFlowStepService = new ProcessStepService();
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
        $this->assertTrue($createNewProcessFlowStep);

    }

    public function test_to_see_if_an_error_happens_when_creating_a_processfolow(): void
    {
        $data                            = new Request([
            "name" => "test name 2",
        ]);
        $createNewProcessFlowStepService = new ProcessStepService();
        $createNewProcessFlowStep        = $createNewProcessFlowStepService->createProcessFlowStep($data);
        $this->assertTrue(!$createNewProcessFlowStep);

    }
}