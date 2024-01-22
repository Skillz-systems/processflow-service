<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProcessFlowServiceRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'start_step_id' => 'nullable|integer',
            'frequency'     => 'required|in:daily,weekly,hourly,monthly,yearly,none',
            'status'        => 'sometimes|boolean',
            'frequency_for' => 'required|in:users,customers,suppliers,contractors,none',
            'day'           => 'nullable|string',
            'week'          => 'nullable|string',

        ];
    }
}
