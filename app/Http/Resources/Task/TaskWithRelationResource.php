<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Thread\ThreadResource;
use App\Http\Resources\User\AssignedUsersResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskWithRelationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => date('d M y h:i A',strtotime($this->due_date)),
            'created_at' => date('d M y h:i A'),
            'threads' => ThreadResource::collection($this->threads),
            'assigned' => AssignedUsersResource::collection($this->users)
        ];
    }
}
