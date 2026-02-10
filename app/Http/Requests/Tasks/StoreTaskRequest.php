<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'priority' => ['required', 'in:low,medium,high'],
            'due_at' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }
}
