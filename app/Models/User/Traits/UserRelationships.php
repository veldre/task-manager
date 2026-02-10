<?php

namespace App\Models\User\Traits;

use App\Models\Task\Task;

trait UserRelationships
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
