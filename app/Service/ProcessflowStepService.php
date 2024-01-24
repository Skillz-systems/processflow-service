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
     * Get a single process flow step by ID and throw an exception if not found
     *
     * @param int $id The ID of the process flow step
     * @return \App\Models\ProcessFlowStep The process flow step model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function viewProcessFlowStep(int $id): ProcessFlowStep
    {
        return ProcessFlowStep::findOrFail($id);
    }
}
