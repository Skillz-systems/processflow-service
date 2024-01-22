<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessFlowStep extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'step_route',
        'assignee_user_route',
        'next_user_designation',
        'next_user_department',
        'next_user_unit',
        'process_flow_id',
        'next_user_location',
        'step_type',
        'user_type',
        'next_step_id',
        'status',
    ];
}
