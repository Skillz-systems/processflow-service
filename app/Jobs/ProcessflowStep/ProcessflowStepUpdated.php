<?php

namespace App\Jobs\ProcessflowStep;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessflowStepUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $processFlowId;
    private $steps;

    /**
     * Create a new job instance.
     *
     * @param string $processFlowId
     * @param array $steps
     */
    public function __construct(string $processFlowId, array $steps)
    {
        $this->processFlowId = $processFlowId;
        $this->steps = $steps;
    }
    public function handle(): void
    {
        //
    }

     public function getData(): array
    {
        return $this->data;
    }
}