<?php

namespace App\Http\Controllers;
use App\Models\WorkflowHistory;
use Illuminate\Http\Request;
use App\Http\Requests\CreateWorkflowHistoryRequest;

class WorkflowController extends Controller
{
    public function createWorkflowHistory(CreateWorkflowHistoryRequest $request)
    {
        try {
            // Extract data from the request
            $userId = $request->input('user_id');
            $taskId = $request->input('task_id');
            $stepId = $request->input('step_id');
            $processFlowId = $request->input('process_flow_id');
            $status = $request->input('status');

            // Create a new workflow history entry
            $historyEntry = new WorkflowHistory([
                'user_id' => $userId,
                'task_id' => $taskId,
                'step_id' => $stepId,
                'process_flow_id' => $processFlowId,
                'status' => $status,
            ]);

            // Save the new history entry
            $historyEntry->save();

            // Return true to indicate success
            return true;
        } catch (\Exception $e) {
            // Log the exception or handle the error as needed
            return false;
        }
    }
}

