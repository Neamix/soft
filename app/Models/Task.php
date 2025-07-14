<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'due_date'
    ];
    
    // Filters 
    
    /**
     * ---------------------------------------------------------
     *  Scope Filter
     * ---------------------------------------------------------
     * Filter the task records according to the given data from 
     * the request 
    */
    public function scopeFilter($query,$request)
    {
        if (isset($request['ticket_id'])) {
            $query->where('id',$request['ticket_id']);
        }

        if (isset($request['due_from'])) {
            $query->where('due_date', '>=', $request['due_from']);
        }

        if (isset($request['due_to'])) {
            $query->where('due_date', '<=', $request['due_to']);
        }

        if (isset($request['status_id'])) {
            $query->where('status_id',$request['status_id']);
        }

        if (isset($request['task_id'])) {
            $query->where('id',$request['task_id']);
        }

        if (isset($request['title'])) {
            $query->where('title','like',"%$request[title]%");
        }

        if (isset($request['status'])) {
            $query->where('status',$request['status']);
        }

        if (isset($request['assigned'])) {
            $query->whereHas('users', function ($subQuery) use ($request) {
                $subQuery->where('user_id', $request['assigned']);
            });
        }
    }

    // Relations 
    public function users ()
    {
        return $this->belongsToMany(User::class);
    }

    public function threads ()
    {
        return $this->hasMany(Thread::class);
    }
}
