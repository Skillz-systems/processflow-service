<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessFlow extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start_step_id',
        'frequency',
        'status',
        'frequency_for',
        'day',
        'week',
    ];
    // protected $casts = [
    //     'status' => 'boolean'
    // ];
}
