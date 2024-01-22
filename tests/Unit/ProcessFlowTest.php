<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
// use PHPUnit\Framework\TestCase;
use App\Service\ProcessFlowService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcessFlowTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_process_flow_with_all_required_fields(): void
    {

        $data                    = new Request([
            "name"          => "Process FLow 1",
            "start_step_id" => 1,
            "frequency"     => "daily",
            "frequency_for" => "users",
            "week"          => "weekly",
            "day"           => "thursday",
            "status"        => true
        ]);
        $createNewProcessService = new ProcessFlowService();
        $createNewProcess        = $createNewProcessService->createProcessFlow($data);
        $this->assertDatabaseHas('process_flows', [
            "name"          => "Process FLow 1",
            "start_step_id" => 1,
            "frequency"     => "daily",
            "frequency_for" => "users",
            "week"          => "weekly",
            "day"           => "thursday",
            "status"        => true
        ]);
        $this->assertTrue($createNewProcess);
    }


    public function test_to_see_if_an_error_happens_when_creating_a_process(): void
    {
        $data                    = new Request([
            "name" => "test name 2",
        ]);
        $createNewProcessService = new ProcessFlowService();
        $createNewProcess        = $createNewProcessService->createProcessFlow($data);
        $this->assertTrue(!$createNewProcess);

    }
}
