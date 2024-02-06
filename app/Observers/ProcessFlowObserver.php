<?php
/**
 * File: ProcessFlowObserver.php
 * Namespace: App\Observers
 *
 * Observer class for the ProcessFlow model.
 *
 * Contains logic to run before and after a ProcessFlow model is updated.
 * Handles updating related ProcessFlowStep models when a ProcessFlow is updated.
 */

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
/**
 * Handle the updated event for a ProcessFlow if it has steps.
 *
 * @param \App\Models\ProcessFlow $processFlow The updated ProcessFlow instance steps.
 *
 * @return void
 */

    public function updated(ProcessFlow $processFlow)
    {

        /**
         * Update the ProcessFlow steps based on the provided input.
         *
         * @var array $steps An array containing the updated steps.
         */

        if (request()->has('steps')) {

            $steps = request()->input('steps');

            foreach ($steps as $step) {

                if (isset($step['id'])) {
                    $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);
                }
                // $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);
            }
        }

        // if ($processFlow->steps) {
        //     foreach ($processFlow->steps as $step) {
        //         $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);
        //     }
        // }

    }
>>>>>>> 63b2932 (update observer)
=======

namespace App\Observers;

use App\Models\ProcessFlow;
use App\Service\ProcessflowStepService;
use Illuminate\Http\Request;

class ProcessFlowObserver
{
<<<<<<< HEAD
<<<<<<< HEAD
    //
>>>>>>> e033fda (added test)
=======
    protected $processFlowService, $processflowStepService;
=======
    protected $processflowStepService;
>>>>>>> e5b15c5 (update processflow with or without steps)

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
>>>>>>> 3447248 (update observer)
}
