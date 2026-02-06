<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task\Traits\TaskAttributes;
use App\Models\Task\Traits\TaskRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use TaskAttributes;
    use TaskRelationships;

    protected $guarded = [];

    protected $casts = [
        'due_at' => 'date',
    ];
}
