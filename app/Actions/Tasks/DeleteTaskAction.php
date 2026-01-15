<?php

namespace App\Actions\Tasks;

use App\Models\Task\Task;
use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;

class DeleteTaskAction
{
    public function __construct(private TaskRepositoryInterface $tasks)
    {
    }

    public function execute(Task $task): void
    {
        $this->tasks->delete($task);
    }
}
