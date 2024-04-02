<?php

namespace App\Service;

use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class UnitService
{
 public function createUnit(array $data): ?Unit
    {

        $this->validateData($data);
        return Unit::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }

     protected function validateData(array $data): void
    {
        $validator = Validator::make($data, [
            'id' => 'required',
            'name' => 'required|string|max:255',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function deleteUnit(int $id): bool
    {
        $unit = Unit::find($id);
        if (!$unit) {
            return false;
        }
        $unit->delete();
        return true;
    }
}