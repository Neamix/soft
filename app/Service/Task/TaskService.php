<?php

namespace App\Service\Task;

use App\Models\Task;

class TaskService
{
    /**
     * -----------------------------------------
     *  Upsert Task
     * -----------------------------------------
     *  Create new task or update current task 
    **/
    public function upsertTask ($request)
    {
        // Upsert the given task
        return Task::updateOrCreate([
            'id' => $request->id ?? null
        ],[
            'title' => $request->title ?? null,
            'description' => $request->description ?? null,
            "status" => $request->status ?? "pending",
            'due_date' => $request->due_date ?? null
        ]);
    }

    /**
     * -----------------------------------------
     *  Assign User
     * -----------------------------------------
     *  Assign/UnAssign user to a certain task
    **/
    public function toggleAssignUser ($request)
    {
        $task = Task::find($request->task_id);
        
        // Check if user is already assigned to toggle it
        $isAssigned = $task->users()->where('user_id', $request->user_id)->exists();
        if ($isAssigned) {
            $task->users()->detach($request->user_id);
        } else {
            $task->users()->attach($request->user_id);
        }

        return $task->users()->get();
    }

    /**
     * -----------------------------------------
     *  Get Assigned Tasks
     * -----------------------------------------
     *  Get list of tasks that assigned to that 
     *  user
    **/
    public function getAssignedTasks ($request)
    {
        return auth()->user()->tasks()->filter($request->all());
    }

    /**
     * -----------------------------------------
     *  Update task status
     * -----------------------------------------
     *  Change the status of a certain task
    **/
    public function updateTaskStatus ($request)
    {
        $task = Task::find($request->task_id);
        $task->status = $request->status;
        $task->save();
        
        return $task;
    }

    /**
     * -----------------------------------------
     *  Filter
     * -----------------------------------------
     *  Filter the ticket based on given requests
    **/
    public function filter ($request)
    {
        $auth = auth()->user();

        // Check if the user is manager or not
        if (!$auth->isManager()) {
            $request->merge(['assigned' => $auth->id]);
        }

        return Task::filter($request->all())->with(['users','threads']);
    }
}
