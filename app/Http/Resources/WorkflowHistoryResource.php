<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkflowHistoryResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    /**
     * @OA\Schema(
     *     schema="WorkflowHistoryResource",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="user_id", type="integer"),
     *     @OA\Property(property="task_id", type="integer"),
     *     @OA\Property(property="step_id", type="integer"),
     *     @OA\Property(property="status", type="integer"),
     *     @OA\Property(property="process_flow_id", type="integer"),
     *    
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>  $this->id,
            'user_id' => $this->user_id,
            'task_id' => $this->task_id,
            'step_id' => $this->step_id,
            'process_flow_id' => $this->process_flow_id,
            'status' => (boolean) $this->status,       
        ];   
    }
}
