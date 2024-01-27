<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessFlowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' =>(string) $this->id,
            'name' => $this->name,
            'start_step_id' => $this->start_step_id,
            'frequency' => $this->frequency,
            'status' =>(boolean) $this->status,
            'frequency_for' => $this->frequency_for,
            'day' => $this->day,
            'week' => $this->week,
        ];
    }
}
