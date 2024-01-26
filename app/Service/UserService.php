<?php

namespace App\Service;

use Exception;
use Illuminate\Http\Request;
// use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{



    /**
     * Create a new user.
     *
     * @param \Illuminate\Http\Request $request The request containing the data for the new process flow step.
     *
     * @return \App\Models\User The created process flow step model & object when there is an error.
     */
    public function createUser(Request $request): ?User
    {
        $model = new User();

        $validator = Validator::make($request->all(), [
            "name"                  => "required",
            "id"            => "required",
            "email"   => "required",
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $model->create($request->all());
    }

   

   }
