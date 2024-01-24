<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'task_id',
        'process_flow_id',
        'step_id',
        'status',
    ];

}
