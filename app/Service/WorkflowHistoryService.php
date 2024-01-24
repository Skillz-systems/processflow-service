<?php

namespace App\Service;

use App\Models\WorkflowHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkflowHistoryService
{

    /**
     * This Method is used to create a new workflow history in the database .
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool True if the workflow history is created successfully, false otherwise.
     * @throws bool False  has an error.
     */

    public function createWorkflowHistory(Request $request): object
    {
        $model = new WorkflowHistory();

        $validator = Validator::make($request->all(), [

            "user_id" => "required",
            "task_id" => "required",
            "step_id" => "required",
            "process_flow_id" => "required",
            "status" => "required",
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $model->create($request->all());

    }
}