<?php

namespace App\Service;

use Exception;
use Illuminate\Http\Request;
// use Exception;
use App\Models\ProcessFlowStep;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProcessflowStepService
{



    /**
     * Create a new process flow step.
     *
     * @param \Illuminate\Http\Request $request The request containing the data for the new process flow step.
     *
     * @return \App\Models\ProcessFlowStep The created process flow step model.
     */
    public function createProcessFlowStep(Request $request): object
    {
        $model = new ProcessFlowStep();

        $validator = Validator::make($request->all(), [

            "name"                  => "required",
            "step_route"            => "required",
            "assignee_user_route"   => "required",
            "next_user_designation" => "required",
            "next_user_department"  => "required",
            "next_user_unit"        => "required",
            "process_flow_id"       => "required",
            "next_user_location"    => "required",
            "step_type"             => "required",
            "user_type"             => "required",
            "next_step_id"          => "required",
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $model->create($request->all());
    }

    /**
     * Get a process flow step model by ID.
     *
     * @param int $id The ID of the process flow step to retrieve.
     * @return \App\Models\ProcessFlowStep|null The process flow step model if found, null otherwise.
     */
    public function getProcessFlowStep(int $id): ?ProcessFlowStep
    {
        return ProcessFlowStep::find($id);
    }

    /**
     * Update an existing process flow step.
     *
     * @param Request $request The request containing the updated data
     * @param int $id The ID of the process flow step to update
     * @return object The updated process flow step model
     * @throws ModelNotFoundException If no process flow step with the given ID is found
     */
    public function updateProcessFlowStep(Request $request, int $id): ProcessFlowStep
    {
        $processFlowStep = $this->getProcessFlowStep($id);

        if (!$processFlowStep) {
            throw new ModelNotFoundException("Model with ID $id not found");
        }

        $validator = Validator::make($request->all(), [
            'name'                  => 'sometimes|string',
            'step_route'            => 'sometimes|string',
            'assignee_user_route'   => 'sometimes|integer',
            'next_user_designation' => 'sometimes|integer',
            'next_user_department'  => 'sometimes|string',
            'process_flow_id'       => 'sometimes|integer',
            'step_type'             => 'sometimes|in:create,delete,update,approve_auto_assign,approve_manual_assign',
            'user_type'             => 'sometimes|in:user,supplier,customer,contractor',
            'status'                => 'sometimes|boolean',
        ]);



        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $processFlowStep->update($request->all());

        return $processFlowStep;
    }
}

