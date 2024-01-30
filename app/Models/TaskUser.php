<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskUser extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'due_date',
        'user_id',
        'task_id',
        'state_id'
    ];

}
