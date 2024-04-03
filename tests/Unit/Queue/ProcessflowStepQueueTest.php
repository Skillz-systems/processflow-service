<?php

namespace Tests\Unit\Queue;

use Tests\TestCase;
use App\Models\ProcessFlow;

use App\Models\ProcessFlowStep;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\ProcessflowStep\ProcessflowStepCreated;
use App\Jobs\ProcessflowStep\ProcessflowStepDeleted;
use App\Jobs\ProcessflowStep\ProcessflowStepUpdated;

class ProcessflowStepQueueTest extends TestCase
{

     use RefreshDatabase;

     public function test_it_dispatches_the_process_flow_step_created_job()
    {
        Queue::fake();
        $step = ProcessFlowStep::factory()->create();
        ProcessflowStepCreated::dispatch($step->toArray());
        Queue::assertPushed(ProcessflowStepCreated::class, function ($job) use ($step) {
            return $job->getData() == $step->toArray();
        });
    }

    public function test_it_dispatches_the_process_flow_step_updated_job()
    {
        Queue::fake();
        $step = ProcessFlowStep::factory()->create();

        ProcessflowStepUpdated::dispatch($step->toArray());
        Queue::assertPushed(ProcessflowStepUpdated::class, function ($job) use ($step) {
            return $job->getData() == $step->toArray();
        });
    }

    public function test_it_handles_process_flow_step_deleted_job(): void
    {

        Queue::fake();
        $step = ProcessFlowStep::factory()->create();
        ProcessflowStepDeleted::dispatch($step->id);
        Queue::assertPushed(ProcessflowStepDeleted::class, function ($job) use ($step) {
            return $job->getId() == $step->id;
        });
    }

}
