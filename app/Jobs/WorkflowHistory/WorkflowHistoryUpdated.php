<?php

namespace App\Jobs\WorkflowHistory;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Service\WorkflowHistoryService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WorkflowHistoryUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   /**
     * The data for updating the workflowhistory.
     *
     * @var array
     */
    private array $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {

    }

     public function getData(): array
    {
        return $this->data;
    }
}