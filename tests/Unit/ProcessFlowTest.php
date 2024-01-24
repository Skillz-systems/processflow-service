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

    public function test_to_see_if_a_processflow_can_be_fetched(): void
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
        $fetchService = $createNewProcessService->getProcessFlow($result->id);
        $this->assertEquals($fetchService->id, $result->id);
        $this->assertInstanceOf(ProcessFlow::class, $fetchService);

    }

    public function test_to_see_if_processflow_returns_a_content(): void
    {
        $createNewProcessService = new ProcessFlowService();
        $fetchService = $createNewProcessService->getProcessFlow(5);

        $this->assertNull($fetchService);

    }

}
