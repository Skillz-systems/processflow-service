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


    public function updateDepartment(array $data, int $id): ?bool
    {
        $this->validateData($data);
        $department = Department::find($id);
        if (!$department) {
            return false;
        }
        return $department->update([
        'name' => $data['name'],
           'created_at' => $data['created_at'],
        'updated_at' => $data['updated_at'],
        ]);
    }


     public function deleteDepartment(int $id): bool
    {
        $department = Department::find($id);
        if (!$department) {
            return false;
        }
        $department->delete();
        return true;
    }

    /**
     * Get a single department by ID.
     *
     * @param int $id
     * @return Department
     * @throws ModelNotFoundException
     */
    public function getSingleDepartment(int $id): ?Department
    {
        return Department::findOrFail($id);
    }



    /**
     * Get all departments.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllDepartments(): \Illuminate\Database\Eloquent\Collection
    {
        return Department::all();
    }

    public function getDepartmentUnit(int $id){
     return Department::with('units')->find($id);
    }

}
