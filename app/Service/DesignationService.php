<?php

namespace App\Service;

use App\Models\Designation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DesignationService
{
    /**
     * Create a new designation.
     *
     * @param array $data
     * @return Designation
     * @throws ValidationException
     */
    public function createDesignation(array $data): Designation
    {
        // Validate the input data
        $this->validateData($data);
        return Designation::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }

    /**
     * Validate the input data.
     *
     * @param array $data
     * @return void
     * @throws ValidationException
     */
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

    public function deleteDesignation(int $id): bool
    {
        $designation = Designation::find($id);
        if (!$designation) {
            return false;
        }
        $designation->delete();
        return true;
    }

    public function updateDesignation(array $data, int $id): bool
    {
        $this->validateData($data);

        $designation = Designation::find($id);
        return $designation->update([
            'name' => $data['name'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }

    public function getAllDesignations(): object
    {
        return Designation::all();
    }
}
