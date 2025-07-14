<?php

namespace App\Http\Requests\Thread;

use App\Constants\GlobConstants;
use App\Models\Task;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ThreadCompleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $thread = Thread::with('task.users')->find($this->thread_id);
    
        if (!$thread) return false;
        
        $authUser = Auth::user();
        if (!$authUser) return false;
        
        $assignedUserIds = $thread->task->users->pluck('id')->toArray();

        return in_array($authUser->id, $assignedUserIds) || $authUser->isManager();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thread_id' => ['required','exists:threads,id'],
            'complete' => ['required','in:1,0'] 
        ];
    }
}
