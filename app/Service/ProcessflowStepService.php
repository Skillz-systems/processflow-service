<?php

namespace App\Service;

use App\Models\ProcessFlowStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProcessflowStepService
{

    public function createProcessFlowStep(Request $request): bool
    {
        $model = new ProcessFlowStep();

        $validator = Validator::make($request->all(), [

            "name" => "required",
            "step_route" => "required",
            "assignee_user_route" => "required",
            "next_user_designation" => "required",
            "next_user_department" => "required",
            "next_user_unit" => "required",
            "process_flow_id" => "required",
            "next_user_location" => "required",
            "step_type" => "required",
            "user_type" => "required",
            "next_step_id" => "required",
        ]);

        if ($validator->fails()) {
            return false;
        }

        if ($model->create($request->all())) {
            return true;
        }
        return false;

    }
}
