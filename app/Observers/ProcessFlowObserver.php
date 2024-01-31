<?php

namespace App\Observers;

use App\Models\ProcessFlow;
use App\Service\ProcessflowStepService;
use Illuminate\Http\Request;

class ProcessFlowObserver
{
    protected $processflowStepService;

    public function __construct(ProcessflowStepService $processflowStepService)
    {
        $this->processflowStepService = $processflowStepService;
    }

    public function updating(ProcessFlow $processFlow)
    {
        // Add logic to run before the process flow is updated

    }

    public function updated(ProcessFlow $processFlow)
    {
        // Add logic to run after the process flow is updated
        if (request()->has('steps')) {

            $steps = request()->input('steps');

            foreach ($steps as $step) {
                $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);
            }

        }

    }
}
