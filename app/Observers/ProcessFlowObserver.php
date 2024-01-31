<?php

namespace App\Observers;

use App\Models\ProcessFlow;
use App\Service\ProcessFlowService;
use App\Service\ProcessflowStepService;
use Illuminate\Http\Request;

class ProcessFlowObserver
{
    protected $processFlowService, $processflowStepService;

    public function __construct(ProcessFlowService $processFlowService, ProcessflowStepService $processflowStepService)
    {
        $this->processflowStepService = $processflowStepService;
    }

    public function updating(ProcessFlow $processFlow)
    {
        // Add logic to run before the process flow is updated
        // $processFlowId = request()->input('id');
        // if (request()->has('steps')) {

        //     $steps = request()->input('steps');
        //     // $steps = $processFlow->steps;
        //     $updatedSteps = [];

        //     foreach ($steps as $index => $step) {
        //         $step = $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);

        //         if ($index === 0) {
        //             $this->processFlowService->updateProcessFlow(['start_step_id' => $step->id], $processFlowId);
        //         }
        //         $updatedSteps[] = $step;
        //     }

        //     foreach ($updatedSteps as $index => $step) {
        //         $next_step_id = $index === count($updatedSteps) - 1 ? null : $updatedSteps[$index + 1]->id;
        //         $this->processflowStepService->updateProcessFlowStep(new Request(['next_step_id' => $next_step_id]), $step->id);
        //     }
        // }
        // else {
        //     $this->processFlowService->updateProcessFlow($processFlow->id, $processFlow);

        // }

    }

    public function updated(ProcessFlow $processFlow)
    {
        // Add logic to run after the process flow is updated

        // $processFlowId = request()->input('id');
        if (request()->has('steps')) {

            $steps = request()->input('steps');

            foreach ($steps as $step) {
                $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);
            }

        }

        // if (request()->has('steps')) {

        //     $steps = request()->input('steps');
        //     // $steps = $processFlow->steps;
        //     $updatedSteps = [];

        //     foreach ($steps as $index => $step) {
        //         $step = $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);

        //         if ($index === 0) {
        //             $this->processFlowService->updateProcessFlow(['start_step_id' => $step->id], $processFlow->id);
        //         }
        //         $updatedSteps[] = $step;
        //     }

        //     foreach ($updatedSteps as $index => $step) {
        //         $next_step_id = $index === count($updatedSteps) - 1 ? null : $updatedSteps[$index + 1]->id;
        //         $this->processflowStepService->updateProcessFlowStep(new Request(['next_step_id' => $next_step_id]), $step->id);
        //     }
        // } else {
        //     $this->processFlowService->updateProcessFlow($processFlow->id, $processFlow);

        // }
    }
}
