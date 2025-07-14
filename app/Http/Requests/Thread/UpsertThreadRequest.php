<?php

namespace App\Http\Requests\Thread;

use App\Constants\GlobConstants;
use Illuminate\Foundation\Http\FormRequest;

class UpsertThreadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role_id == GlobConstants::ROLE_MANAGER;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required','string'],
            'task_id' => ['required','exists:tasks,id']
        ];
    }
}
