<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StatusTaskChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $task = Task::where('id',$this->task_id)->with('users')->first();

        if (!$task) return false;

        $authUser = Auth::user();
        if ($authUser->isManager()) return true;

        $assignedUserIds = $task->users->pluck('id')->toArray();
        return in_array($authUser->id,$assignedUserIds);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task_id' => ['required','exists:tasks,id',function ($attribute,$value,$fail) {
                $hasIncompleteThreads = Task::where('id',$value)
                ->whereHas('threads', function($query) {
                    $query->where('complete', 0);
                })->count();
                    
                if ($hasIncompleteThreads && $this->status == "complete") {
                    return $fail("All Threads must be completed");
                }
            }],
            'status' => ['required','in:pending,complete']
        ];
    }
}
