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
            "email" => "required",
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $model->create($request->all());
    }

    /**
     * Retrieve a ProcessFlow by its ID.
     *
     * @param int $id The ID of the ProcessFlow to retrieve.
     *
     * @return \App\Models\User|null The retrieved ProcessFlow, or null if not found.
     */

    public function getUser(int $id): User | null
    {
        return User::find($id);
    }

}
