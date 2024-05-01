<?php

namespace Tests\Unit\Queue;

use Tests\TestCase;
use App\Models\ProcessFlow;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessFlow\ProcessFlowCreated;
use App\Jobs\ProcessFlow\ProcessFlowDeleted;
use App\Jobs\ProcessFlow\ProcessFlowUpdated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcessFlowQueueTest extends TestCase
{
   use RefreshDatabase;

 public function test_it_dispatches_the_process_flow_created_job()
    {
        Queue::fake();
        $processFlow = ProcessFlow::factory()->create();
        ProcessFlowCreated::dispatch($processFlow->toArray());
        Queue::assertPushed(ProcessFlowCreated::class, function ($job) use ($processFlow) {
            return $job->getData() == $processFlow->toArray();
        });
    }

public function test_it_dispatches_the_process_flow_updated_job()
    {
        Queue::fake();
        $processFlow = ProcessFlow::factory()->create();

        ProcessFlowUpdated::dispatch($processFlow->toArray());
        Queue::assertPushed(ProcessFlowUpdated::class, function ($job) use ($processFlow) {
            return $job->getData() == $processFlow->toArray();
        });
    }

    public function test_it_handles_process_flow_deleted_job(): void
    {

        Queue::fake();
        $processFlow = ProcessFlow::factory()->create();
        ProcessFlowDeleted::dispatch($processFlow->id);
        Queue::assertPushed(ProcessFlowDeleted::class, function ($job) use ($processFlow) {
            return $job->getId() == $processFlow->id;
        });
    }
}
