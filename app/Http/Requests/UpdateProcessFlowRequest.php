<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcessFlowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'name' => 'sometimes|string|max:255|unique:process_flows,name',
            'start_step_id' => 'sometimes',
            'frequency' => 'sometimes|in:daily,weekly,hourly,monthly,yearly,none',
            'status' => 'sometimes|boolean',
            'frequency_for' => 'sometimes|in:users,customers,suppliers,contractors,none',
            'day' => 'nullable|string',
            'week' => 'nullable|string',
        ];
    }
}
