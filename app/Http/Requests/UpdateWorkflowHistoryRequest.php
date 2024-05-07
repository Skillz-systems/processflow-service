<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="UpdateWorkflowHistoryRequest",
 *      description="Update workflow history request data",
 *      type="object",
 *      required={"status"} 
 * )
 */
class UpdateWorkflowHistoryRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      property="user_id",
     *      type="integer",
     *      description="User ID"
     * )
     *
     * @OA\Property(
     *      property="task_id",
     *      type="integer",
     *      description="Task ID"
     * )
     *
     * @OA\Property(
     *      property="step_id",
     *      type="integer",
     *      description="Step ID"
     * )
     *
     * @OA\Property(
     *      property="process_flow_id",
     *      type="integer",
     *      description="Process Flow ID"
     * )
     *
     * @OA\Property(
     *      property="status",
     *      type="boolean",
     *      description="Status"
     * )
     */
    public function rules(): array
    {return [
            'user_id'            => 'sometimes|integer',
            'task_id'            => 'sometimes|integer',
            'step_id'            => 'sometimes|integer',
            'process_flow_id'    => 'sometimes|integer',
            'status'             => 'sometimes|boolean',
        ];
    }
}
