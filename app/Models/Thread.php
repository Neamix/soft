<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'description',
        'complete',
        'task_id'
    ];

    // Relations
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
