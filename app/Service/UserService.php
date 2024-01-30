<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UserService
{

    /**
     * Create a new user.
     *
     * @param \Illuminate\Http\Request $request The request containing the data for the new user.
     *
     * @return \App\Models\User \ Illuminate\Support\MessageBag The created user model & MessageBag when there is an error.
     */
    public function createUser(Request $request): User | MessageBag
    {
        $model = new User();

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "id" => "required",
            "email" => "required|email|unique:users",
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $model->create($request->all());
    }

    /**
     * Retrieve a Puder by its ID.
     *
     * @param int $id The ID of the user to retrieve.
     *
     * @return \App\Models\User|null The retrieved user, or null if not found.
     */

    public function getUser(int $id): User | null
    {
        return User::find($id);
    }

    /**
     * Update an existing user.
     *
     * @param int $id The ID of the user to update.
     * @param \Illuminate\Http\Request $request The HTTP request containing the updated data.
     *
     * @return \App\Models\User The updated user instance.
     *
     * @throws \Exception If validation fails or if an error occurs during the update.
     */

    public function updateUser(int $id, Request $request): User
    {
        $model = User::find($id);
        // validation

        $validator = Validator::make($request->all(), [
            "name" => "sometimes",
            "id" => "sometimes",
            "email" => "sometimes|email|unique:users|",
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        if ($model) {
            if ($model->update($request->all())) {
                return $model;
            }
            throw new \Exception('Something went wrong.');

        }
        throw new \Exception('Something went wrong.');

    }

    /**
     * Delete a User by its ID.
     *
     * @param int $id The ID of the User to delete.
     *
     * @return bool True if the deletion is successful, false otherwise.
     */

    public function deleteUser(int $id): bool
    {
        $model = User::find($id);
        if ($model) {
            if ($model->delete()) {
                return true;

            }

        }
        return false;

    }

}
