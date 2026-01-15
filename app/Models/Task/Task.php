<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task\Traits\TaskAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use TaskAttributes;

    protected $guarded = [];

    protected $casts = [
        'due_at' => 'date',
    ];
}
