<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StatusTaskChangeRequest;
use App\Http\Requests\Task\AssignTaskRequest;
use App\Http\Requests\Task\FilterTaskRequest;
use App\Http\Requests\Task\UpsertTaskRequest;
use App\Http\Resources\Task\TaskResource;
use App\Http\Resources\Task\TaskWithRelationResource;
use App\Http\Resources\User\AssignedUsersResource;
use App\Service\Task\TaskService;
use PHPUnit\Framework\Attributes\Ticket;

class TaskController extends Controller
{
    protected $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function upsertTask (UpsertTaskRequest $request) 
    {
        $response = $this->taskService->upsertTask($request);
        return [
            'status' => 'success',
            'task' => new TaskResource($response)
        ];
    }

    public function toggleAssignUser (AssignTaskRequest $request)
    {
        $response = $this->taskService->toggleAssignUser($request);
        return [
            'status' => 'success',
            'task' => AssignedUsersResource::collection($response)
        ];
    }

    public function changeStatus (StatusTaskChangeRequest $request)
    {
        $response = $this->taskService->updateTaskStatus($request);
        return [
            'status' => 'success',
            'task' => new TaskResource($response)
        ];
    }

    public function filter(FilterTaskRequest $request)
    {
        $response = $this->taskService->filter($request)->get();
        return [
            'status' => 'success',
            'task' => TaskWithRelationResource::collection($response)
        ];
    }
}
