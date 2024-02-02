<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="UpdateProcessFlowRequest",
 *     description="update process flow request body data",
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
class UpdateProcessFlowRequest extends FormRequest
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
            'name' => 'sometimes|nullable',
            "start_step_id" => "sometimes|nullable|integer",
            "frequency" => "sometimes|nullable|in:daily,weekly,hourly,monthly,yearly,none",
            "status" => "sometimes|nullable|boolean",
            "frequency_for" => "sometimes|nullable|in:users,customers,suppliers,contractors,none",
            "day" => "sometimes|nullable|string",
            "week" => "sometimes|nullable|string",
        ];
    }
}
