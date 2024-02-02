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
 *     ),
 *     @OA\Property(
 *         property="start_step_id",
 *         type="integer",
 *         nullable=true,
 *         description="ID of the starting step (if applicable)",
 *     ),
 *     @OA\Property(
 *         property="frequency",
 *         description="Frequency of the process flow (daily, weekly, hourly, monthly, yearly, none)",
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="boolean",
 *         description="Status of the process flow (active/inactive)",
 *     ),
 *     @OA\Property(
 *         property="frequency_for",
 *         description="Frequency for specific entities (users, customers, suppliers, contractors, none)",
 *     ),
 *     @OA\Property(
 *         property="day",
 *         type="string",
 *         nullable=true,
 *         description="Day of the week (if applicable)",
 *     ),
 *     @OA\Property(
 *         property="week",
 *         type="string",
 *         nullable=true,
 *         description="Week of the month (if applicable)",
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
