<?php

namespace App\Service;


use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class DepartmentService
{
 public function createDepartment(array $data)
    {

        $this->validateData($data);
        return Department::create([
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

}
