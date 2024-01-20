<?php

namespace Tests\Unit;

use App\Service\ProcessflowStepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ProcessFlowStepTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */

    public function test_to_see_if_the_processfolow_was_created(): void
    {
        $data = new Request([
            "name" => "test name",
            "step_route" => "this should be a route",
            "assignee_user_route" => 1,
            "next_user_designation" => 1,
            "next_user_department" => 1,
            "next_user_unit" => 1,
            "process_flow_id" => 1,
            "next_user_location" => 1,
            "step_type" => "create",
            "user_type" => "customer",
            "next_step_id" => 2,
            "status" => 1,
        ]);
        $createNewProcessFlowStepService = new ProcessflowStepService();
        $createNewProcessFlowStep = $createNewProcessFlowStepService->createProcessFlowStep($data);
        $this->assertDatabaseHas('process_flow_steps', [
            "name" => "test name",
            "step_route" => "this should be a route",
            "assignee_user_route" => 1,
            "next_user_designation" => 1,
            "next_user_department" => 1,
            "next_user_unit" => 1,
            "process_flow_id" => 1,
            "next_user_location" => 1,
            "step_type" => "create",
            "user_type" => "customer",
            "next_step_id" => 2,
            "status" => 1,
        ]);
        $this->assertTrue($createNewProcessFlowStep);

    }
}
