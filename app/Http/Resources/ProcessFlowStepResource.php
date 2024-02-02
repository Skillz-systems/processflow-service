<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ProcessFlowStepResource",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="step_route", type="string"),
 *     @OA\Property(property="assignee_user_route", type="integer"),
 *     @OA\Property(property="next_user_designation", type="integer"),
 *     @OA\Property(property="next_user_department", type="integer"),
 *     @OA\Property(property="next_user_unit", type="integer"),
 *     @OA\Property(property="process_flow_id", type="integer"),
 *     @OA\Property(property="next_user_location", type="integer"),
 *     @OA\Property(property="step_type", type="string"),
 *     @OA\Property(property="user_type", type="string"),
 *     @OA\Property(property="next_step_id", type="integer"),
 *     @OA\Property(property="status", type="integer"),
 * )
 */

class ProcessFlowStepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'step_route' => $this->step_route,
            'assignee_user_route' => $this->assignee_user_route,
            'next_user_designation' => $this->next_user_designation,
            'next_user_department' => $this->next_user_department,
            'next_user_unit' => $this->next_user_unit,
            'process_flow_id' => $this->process_flow_id,
            'next_user_location' => $this->next_user_location,
            'step_type' => $this->step_type,
            'user_type' => $this->user_type,
            'next_step_id' => $this->next_step_id,
            'status' => $this->status,

        ];
    }
}
