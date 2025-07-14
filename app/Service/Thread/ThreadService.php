<?php

namespace App\Service\Thread;

use App\Models\Thread;

class ThreadService
{
    public function upsertThread ($request)
    {
        return Thread::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'description' => $request->description,
                'task_id' => $request->task_id
            ]
        );
    }

    public function setThreadComplete($request)
    {
        $thread = Thread::find($request->thread_id);
        $thread->complete = $request->complete;
        $thread->save();
        
        return $thread;
    }
}
