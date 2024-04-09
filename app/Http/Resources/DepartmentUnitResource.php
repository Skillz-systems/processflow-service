<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UnitResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentUnitResource extends JsonResource
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
            'units' => UnitResource::collection($this->units),
        ];
    }
}