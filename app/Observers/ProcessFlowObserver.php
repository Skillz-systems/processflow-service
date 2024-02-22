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
use App\Models\ProcessFlowStep;
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
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
=======
>>>>>>> origin/NGMC-92-Create-a-route-that-would-be-used-to-fetch-all-workflow-history

    /**
     * Handle the deleted event for a ProcessFlow.
     *
     * Delete all the steps associated with the deleted ProcessFlow.
     *
     * @param \App\Models\ProcessFlow $processFlow The deleted ProcessFlow instance.
     *
     * @return void
     */
    public function deleting(ProcessFlow $processFlow)
    {

        if ($processFlow->steps()->count() > 0) {
            $steps = ProcessFlowStep::where('process_flow_id', $processFlow->id)->get();

            $stepsCollection = collect($steps);

            $stepsCollection->each(function ($step) {
                $this->processflowStepService->deleteProcessFlowStep($step->id);
            });
        }

    }
<<<<<<< HEAD
=======
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
>>>>>>> c717375 (added test)
<<<<<<< HEAD
>>>>>>> cedd4fa (added test)
=======
=======
    protected $processFlowService, $processflowStepService;
=======
    protected $processflowStepService;
>>>>>>> 8462c4e (update processflow with or without steps)

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
            // $steps = $processFlow->steps;
            $updatedSteps = [];

            foreach ($steps as $index => $step) {
                $step = $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);

                // if ($index === 0) {
                //     $this->processFlowService->updateProcessFlow(['start_step_id' => $step->id], $processFlow->id);
                // }
                $updatedSteps[] = $step;
            }

            foreach ($updatedSteps as $index => $step) {
                $next_step_id = $index === count($updatedSteps) - 1 ? null : $updatedSteps[$index + 1]->id;
                $this->processflowStepService->updateProcessFlowStep(new Request(['next_step_id' => $next_step_id]), $step->id);
            }
        }

        // if ($processFlow->steps) {
        //     foreach ($processFlow->steps as $step) {
        //         $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);
        //     }
        // }

    }
=======
>>>>>>> 4c20092 (document observer)
=======
>>>>>>> b4d02d3 (first code draft)
>>>>>>> 63b2932 (update observer)
<<<<<<< HEAD
>>>>>>> 56b5cde (update observer)
=======
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
<<<<<<< HEAD
>>>>>>> f35e6ff (added test)
=======
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
            // $steps = $processFlow->steps;
            $updatedSteps = [];

            foreach ($steps as $index => $step) {
                $step = $this->processflowStepService->updateProcessFlowStep(new Request($step), $step['id']);

                // if ($index === 0) {
                //     $this->processFlowService->updateProcessFlow(['start_step_id' => $step->id], $processFlow->id);
                // }
                $updatedSteps[] = $step;
            }

            foreach ($updatedSteps as $index => $step) {
                $next_step_id = $index === count($updatedSteps) - 1 ? null : $updatedSteps[$index + 1]->id;
                $this->processflowStepService->updateProcessFlowStep(new Request(['next_step_id' => $next_step_id]), $step->id);
            }
        }

    }
>>>>>>> 3447248 (update observer)
<<<<<<< HEAD
>>>>>>> 974e109 (update observer)
=======
=======

    /**
     * Handle the deleted event for a ProcessFlow.
     *
     * Delete all the steps associated with the deleted ProcessFlow.
     *
     * @param \App\Models\ProcessFlow $processFlow The deleted ProcessFlow instance.
     *
     * @return void
     */
    public function deleting(ProcessFlow $processFlow)
    {
<<<<<<< HEAD
=======

>>>>>>> 52670e4 (swagger bugs fixed)
        if ($processFlow->steps()->count() > 0) {
            $steps = ProcessFlowStep::where('process_flow_id', $processFlow->id)->get();

<<<<<<< HEAD
    //     // Add logic to run after the process flow is deleted
    //     // $this->processflowStepService->deleteProcessFlowStep($processFlow->id);
    // }
>>>>>>> 3edf406 (first code draft)
>>>>>>> b4d02d3 (first code draft)
=======
            foreach ($steps as $step) {
                $step->delete();
            }
        }
    }
>>>>>>> 744c314 (observer code added)
=======
>>>>>>> origin/NGMC-92-Create-a-route-that-would-be-used-to-fetch-all-workflow-history
}
