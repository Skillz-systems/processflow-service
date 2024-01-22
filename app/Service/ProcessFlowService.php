<?php
namespace App\Service;

use App\Models\ProcessFlow;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ProcessFlowService
{

    /**
     * Create a new process flow.
     *
     * @param  Request  $request
     * @return bool
     */
    public function createProcessFlow(Request $request): bool
    {
        // Instantiate a new ProcessFlow model
        $model = new ProcessFlow();

        // Validate the request data
        $validator = Validator::make($request->all(), [

            "name"          => "required|string|max:255",
            "start_step_id" => "nullable|integer",
            "frequency"     => "required|in:daily,weekly,hourly,monthly,yearly,none",
            "status"        => "sometimes|boolean",
            "frequency_for" => "required|in:users,customers,suppliers,contractors,none",
            "day"           => "nullable|string",
            "week"          => "nullable|string",
        ]);
        // Return false if validation fails
        if ($validator->fails()) {
            return false;
        }
        // Create a new process flow and return true if successful, otherwise return false
        if ($model->create($request->all())) {
            return true;
        }
        return false;

    }
}
