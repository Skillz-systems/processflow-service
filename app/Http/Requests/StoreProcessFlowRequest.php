<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="StoreProcessFlowRequest",
 *     description="Store process flow request body data",
 *     type="object",
 *     required={"name", "frequency", "frequency_for"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=255,
 *         description="The name of the process flow",
<<<<<<< HEAD
<<<<<<< HEAD
 *         example="Sample Process Flow"
=======
=======
 *         example="Sample Process Flow"
>>>>>>> 5403df7 (swagger documentation)
 *     ),
 *     @OA\Property(
<<<<<<< HEAD
 *         property="start_step_id",
 *         type="integer",
 *         nullable=true,
 *         description="ID of the starting step (if applicable)",
<<<<<<< HEAD
>>>>>>> c0348c4 (swagger documentation)
=======
 *         example=1
>>>>>>> 5403df7 (swagger documentation)
 *     ),
 *     @OA\Property(
=======
>>>>>>> 8142ce7 (update documentation)
 *         property="frequency",
 *         description="Frequency of the process flow (daily, weekly, hourly, monthly, yearly, none)",
<<<<<<< HEAD
<<<<<<< HEAD
 *         example="daily"
=======
>>>>>>> c0348c4 (swagger documentation)
=======
 *         example="daily"
>>>>>>> 5403df7 (swagger documentation)
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="boolean",
 *         description="Status of the process flow (active/inactive)",
<<<<<<< HEAD
<<<<<<< HEAD
 *         example=true
=======
>>>>>>> c0348c4 (swagger documentation)
=======
 *         example=true
>>>>>>> 5403df7 (swagger documentation)
 *     ),
 *     @OA\Property(
 *         property="frequency_for",
 *         description="Frequency for specific entities (users, customers, suppliers, contractors, none)",
<<<<<<< HEAD
<<<<<<< HEAD
 *         example="users"
=======
>>>>>>> c0348c4 (swagger documentation)
=======
 *         example="users"
>>>>>>> 5403df7 (swagger documentation)
 *     ),
 *     @OA\Property(
 *         property="day",
 *         type="string",
 *         nullable=true,
 *         description="Day of the week (if applicable)",
<<<<<<< HEAD
<<<<<<< HEAD
 *         example="Monday"
=======
>>>>>>> c0348c4 (swagger documentation)
=======
 *         example="Monday"
>>>>>>> 5403df7 (swagger documentation)
 *     ),
 *     @OA\Property(
 *         property="week",
 *         type="string",
 *         nullable=true,
 *         description="Week of the month (if applicable)",
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 5403df7 (swagger documentation)
 *         example="first"
 *     ),
 *     @OA\Property(
 *         property="steps",
 *         type="array",
 *         nullable=true,
 *         description="List of all the steps for the process flow",
 *         @OA\Items(
 *             type="object",
 *             required={"name", "step_route", "assignee_user_route", "next_user_designation", "next_user_department", "next_user_unit", "process_flow_id", "next_user_location", "step_type", "user_type", "status"},
 *             @OA\Property(
 *                 property="name",
 *                 description="Description",
 *                 type="string",
 *                 example="Step 1"
 *             ),
 *             @OA\Property(
 *                 property="step_route",
 *                 description="Step route",
 *                 type="string",
 *                 example="/step1"
 *             ),
 *             @OA\Property(
 *                 property="assignee_user_route",
 *                 description="Assignee user route",
 *                 type="string",
 *                 example="/assignee1"
 *             ),
 *             @OA\Property(
 *                 property="next_user_designation",
 *                 description="Next user designation",
 *                 type="string",
 *                 example="Manager"
 *             ),
 *             @OA\Property(
 *                 property="next_user_department",
 *                 description="Next user Department",
 *                 type="string",
 *                 example="HR"
 *             ),
 *             @OA\Property(
 *                 property="next_user_unit",
 *                 description="Next user unit",
 *                 type="string",
 *                 example="Finance"
 *             ),
 *             @OA\Property(
 *                 property="process_flow_id",
 *                 description="Process flow ID, should be nullable",
 *                 type="integer",
 *                 example=123
 *             ),
 *             @OA\Property(
 *                 property="next_user_location",
 *                 description="next_user_location",
 *                 type="string",
 *                 example="Office A"
 *             ),
 *             @OA\Property(
 *                 property="step_type",
 *                 description="step_type",
 *                 type="string",
 *                 example="Approval"
 *             ),
 *             @OA\Property(
 *                 property="status",
 *                 description="status",
 *                 type="boolean",
 *                 example="active"
 *             ),
 *         ),
<<<<<<< HEAD
=======
>>>>>>> c0348c4 (swagger documentation)
=======
>>>>>>> 5403df7 (swagger documentation)
 *     ),
 * )
 */

class StoreProcessFlowRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:process_flows,name',
            'start_step_id' => 'nullable|integer',
            'frequency' => 'required|in:daily,weekly,hourly,monthly,yearly,none',
            'status' => 'sometimes|boolean',
            'frequency_for' => 'required|in:users,customers,suppliers,contractors,none',
            'day' => 'nullable|string',
            'week' => 'nullable|string',
        ];
    }
}
