<?php

namespace App\Repositories\Tasks;

use App\Models\Task\Task;
use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;

class DatabaseTaskRepository implements TaskRepositoryInterface
{
    public function create(array $data): Task
    {
        return Task::create($data);
    }
}
