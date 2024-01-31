<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkflowHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'user_id' => $this->user_id,
            'task_id' => $this->task_id,
            'step_id' => $this->step_id,
            'process_flow_id' => $this->process_flow_id,
            'status' => (boolean) $this->status,       
        ];   
    }
}
