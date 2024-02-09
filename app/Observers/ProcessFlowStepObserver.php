<?php

namespace App\Observers;

use App\Models\ProcessFlow;
use App\Models\ProcessFlowStep;
use App\Service\ProcessflowStepService;

class ProcessFlowStepObserver
{

    protected $processflowStepService;

    public function __construct(ProcessflowStepService $processflowStepService)
    {
        $this->processflowStepService = $processflowStepService;
    }

    /**
     * Handle the ProcessFlowStep "created" event.
     */
    public function created(ProcessFlowStep $processFlowStep): void
    {
        //
    }

    /**
     * Handle the ProcessFlowStep "updated" event.
     */
    public function updated(ProcessFlowStep $processFlowStep): void
    {
        //
    }

    /**
     * Handle the ProcessFlowStep "deleted" event.
     */
    public function deleted(ProcessFlowStep $processFlowStep): void
    {
        //
    }

    /**
     * Handle the ProcessFlowStep "deleted" event.
     */
    public function deleting(ProcessFlowStep $processFlowStep): void
    {
        // check if there is any processflow with the process flow step id as its start id
        $processFlowModel = ProcessFlow::where(["start_step_id" => $processFlowStep->id])->first();
        if ($processFlowModel) {
            $processFlowModel->start_step_id = $processFlowStep->next_step_id;
            $processFlowModel->save();
        } else {
            // get the previous step
            $model = ProcessFlowStep::where(["next_step_id" => $processFlowStep->id])->first();
            $model->next_step_id = $processFlowStep->next_step_id;
            $model->save();

        }

    }

    /**
     * Handle the ProcessFlowStep "restored" event.
     */
    public function restored(ProcessFlowStep $processFlowStep): void
    {
        //
    }

    /**
     * Handle the ProcessFlowStep "force deleted" event.
     */
    public function forceDeleted(ProcessFlowStep $processFlowStep): void
    {
        //
    }
}
