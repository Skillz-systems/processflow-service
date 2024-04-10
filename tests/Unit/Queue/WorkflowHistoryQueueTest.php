<?php

namespace Tests\Unit\Queue;

use Tests\TestCase;
use App\Models\ProcessFlow;
use App\Models\WorkflowHistory;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\WorkflowHistory\WorkflowHistoryCreated;
use App\Jobs\WorkflowHistory\WorkflowHistoryDeleted;
use App\Jobs\WorkflowHistory\WorkflowHistoryUpdated;

class WorkflowHistoryQueueTest extends TestCase
{
     use RefreshDatabase;

 public function test_it_dispatches_the_workflow_history_created_job()
    {
        Queue::fake();

         $workflowHistory = WorkflowHistory::factory()->create();
        WorkflowHistoryCreated::dispatch($workflowHistory->toArray());
        Queue::assertPushed(WorkflowHistoryCreated::class, function ($job) use ($workflowHistory) {
            return $job->getData() == $workflowHistory->toArray();
        });
    }

public function test_it_dispatches_the_workflow_history_updated_job()
    {
        Queue::fake();
      $workflowHistory = WorkflowHistory::factory()->create();

        WorkflowHistoryUpdated::dispatch($workflowHistory->toArray());
        Queue::assertPushed(WorkflowHistoryUpdated::class, function ($job) use ($workflowHistory) {
            return $job->getData() == $workflowHistory->toArray();
        });
    }

    public function test_it_handles_workflow_history_deleted_job(): void
    {

        Queue::fake();
         $workflowHistory = WorkflowHistory::factory()->create();
        WorkflowHistoryDeleted::dispatch($workflowHistory->id);
        Queue::assertPushed(WorkflowHistoryDeleted::class, function ($job) use ($workflowHistory) {
            return $job->getId() == $workflowHistory->id;
        });
    }
}