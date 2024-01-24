<?php

namespace App\Service;

use App\Models\ProcessFlowStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProcessflowStepService
{

    /**
     * This Method is used to create a new process flow step in the database .
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool True if the process flow step is created successfully, false otherwise.
     * @throws bool False  has an error.
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

    public function updateProcessFlowStep(Request $request, int $id): ?ProcessFlowStep
    {
        $processFlowStep = $this->getProcessFlowStep($id);

        if (!$processFlowStep) {
            return null;
        }

        // $processFlow = ProcessFlowStep::find($id);
        $validator = Validator::make($request->all(), [

            // "name"                  => "sometimes|string",
            // "step_route"            => "sometimes",
            // "assignee_user_route"   => "sometimes",
            // "next_user_designation" => "sometimes",
            // "next_user_department"  => "sometimes",
            // "next_user_unit"        => "sometimes",
            // "process_flow_id"       => "sometimes",
            // "next_user_location"    => "sometimes",
            // "step_type"             => "sometimes",
            // "user_type"             => "sometimes",
            // "next_step_id"          => "sometimes",

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
            // return $validator->errors();
            return null;
        }

        // $step->update($request->all());
        $processFlowStep->update($request->all());

        return $processFlowStep;

    }
}
