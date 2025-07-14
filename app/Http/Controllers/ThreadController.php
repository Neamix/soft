<?php

namespace App\Http\Controllers;

use App\Http\Requests\Thread\ThreadCompleteRequest;
use App\Http\Requests\Thread\UpsertThreadRequest;
use App\Http\Resources\Thread\ThreadResource;
use App\Service\Thread\ThreadService;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    protected $threadService;
    public function __construct(ThreadService $threadService)
    {
        $this->threadService = $threadService;    
    }

    public function upsertThread (UpsertThreadRequest $request)
    {
        $response = $this->threadService->upsertThread($request);
        return [
            'status' => 'success',
            'thread' => new ThreadResource($response)
        ];
    }

    public function setThreadComplete(ThreadCompleteRequest $request)
    {
        $response = $this->threadService->setThreadComplete($request);
        return [
            'status' => 'success',
            'thread' => new ThreadResource($response)
        ];
    }
}
