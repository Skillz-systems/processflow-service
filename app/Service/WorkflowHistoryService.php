<?php

namespace App\Service;

use App\Models\WorkflowHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WorkflowHistoryService
{
    /**
     * Retrieve all workflow histories.
     *
     * This method retrieves all workflow histories from the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\WorkflowHistory[]
     *
     * @throws \Exception If an error occurs while retrieving the workflow histories.
    */
    public function getWorkflowHistories(Request $request)
{
    return WorkflowHistory::all();
}

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

    /**
     * Retrieve a WorkflowHistory by its ID.
     *
     * @param int $id The ID of the WorkflowHistory to retrieve.
     *
     * @return \App\Models\WorkflowHistory|null The retrieved WorkflowHistory, or null if not found.
     */

     public function getWorkflowHistory(int $id): WorkflowHistory | null
     {
         return WorkflowHistory::find($id);
     }

     /**
     * Update an existing workflow History.
     *
     * @param Request $request The request containing the updated data
     * @param int $id The ID of the workflow history to update
     * @return object The updated workflow History model
     * @throws ModelNotFoundException If no workflow History with the given ID is found
     */
    public function updateWorkflowHistory(Request $request, int $id): WorkflowHistory
    {
        $workflowHistory = $this->getWorkflowHistory($id);

        if (!$workflowHistory) {
            throw new ModelNotFoundException("ID $id not found");
        }

        $validator = Validator::make($request->all(), [
            'user_id'            => 'sometimes|integer',
            'task_id'            => 'sometimes|integer',
            'step_id'            => 'sometimes|integer',
            'process_flow_id'    => 'sometimes|integer',
            'status'             => 'sometimes|boolean',
        ]);



        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $workflowHistory->update($request->all());

        return $workflowHistory;
    }

        /**
     * Delete a WorkflowHistory by its ID.
     *
     * @param int $id The ID of the WorkflowHistory to delete.
     *
     * @return bool True if the deletion is successful, false otherwise.
     */

     public function deleteWorkflowHistory(int $id): bool
     {
         $model = WorkflowHistory::find($id);
         if ($model) {
             if ($model->delete()) {
                 return true;
              }
         }
         return false;
     }
}