<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'priority' => ['sometimes', 'in:low,medium,high'],
            'due_at' => ['sometimes', 'nullable', 'date'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (! $this->hasAny(['title', 'priority', 'due_at'])) {
                $validator->errors()->add('payload', 'At least one field must be provided.');
            }
        });
    }
}
