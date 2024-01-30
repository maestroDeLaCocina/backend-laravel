<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'active',
        'due_date',
        'todo_id',
        'state_id',
    ];
    public function todo():BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }
    public function state():BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    public function steps():HasMany
    {
        return $this->hasMany(Step::class);
    }

}
