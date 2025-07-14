<?php

namespace App\Http\Requests\Task;

use App\Constants\Constants;
use App\Constants\GlobConstants;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpsertTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role_id == GlobConstants::ROLE_MANAGER ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'description' => ['string'],
            'due_date' => ['date_format:Y-m-d H:i:s']
        ];
    }
}
