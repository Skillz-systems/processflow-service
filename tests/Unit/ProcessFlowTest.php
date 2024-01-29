<?php

namespace Tests\Unit;

use App\Models\ProcessFlow;
use App\Service\ProcessFlowService;
// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class ProcessFlowTest extends TestCase
{
    use RefreshDatabase;
    public function test_to_see_if_a_processflow_can_be_created(): void
    {

        $data = new Request([
            "name" => "Process Flow 1",
            "start_step_id" => 1,
            "frequency" => "daily",
            "frequency_for" => "users",
            "week" => "weekly",
            "day" => "thursday",
            "status" => true,
        ]);

        $createNewProcessService = new ProcessFlowService();
        $result = $createNewProcessService->createProcessFlow($data);

        $this->assertDatabaseHas('process_flows', $data->all());
        $this->assertInstanceOf(ProcessFlow::class, $result);
    }

    public function test_to_see_if_an_error_happens_when_creating_a_process(): void
    {

        $data = new Request([
            "name" => "This is new service",
        ]);

        $createNewProcessService = new ProcessFlowService();
        $result = $createNewProcessService->createProcessFlow($data);
        $resultArray = $result->toArray();
        $this->assertNotEmpty($result);
        $this->assertIsArray($resultArray);
        $this->assertArrayHasKey('frequency', $resultArray);
        $this->assertArrayHasKey('frequency_for', $resultArray);

    }

    public function test_to_if_a_processflow_can_be_deleted()
    {
        $data = new Request([
            "name" => "Process Flow 1",
            "start_step_id" => 1,
            "frequency" => "daily",
            "frequency_for" => "users",
            "week" => "weekly",
            "day" => "thursday",
            "status" => true,
        ]);

        $createNewProcessService = new ProcessFlowService();
        $data = $createNewProcessService->createProcessFlow($data);
        $this->assertDatabaseCount("process_flows", 1);
        $delete = $createNewProcessService->deleteProcessflow($data->id);
        // check ifit was removed fromthe db
        $this->assertDatabaseMissing("process_flows", ["name" => "Process Flow 1"]);
        $this->assertTrue($delete);

    }

    public function test_to_see_if_there_is_no_record_with_the_provided_id()
    {
        $createNewProcessService = new ProcessFlowService();
        $delete = $createNewProcessService->deleteProcessflow(5);
        $this->assertFalse($delete);

    }

}
