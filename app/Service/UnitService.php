<?php

namespace App\Service;

use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UnitService
{
 public function createUnit(array $data): ?Unit
    {

        return Unit::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }
}