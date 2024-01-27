<?php

namespace App\Models;

use App\Models\ProcessFlowStep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected $casts = [
        'status' => 'boolean'
    ];

    public function steps():HasMany{
        return $this->hasMany(ProcessFlowStep::class);
    }
}
