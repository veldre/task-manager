<?php

namespace App\Actions\Tasks;

use App\Actions\Tasks\DTO\UpdateTaskDTO;
use App\Models\Task\Task;
use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;

class UpdateTaskAction
{
    public function __construct(private TaskRepositoryInterface $tasks)
    {
    }

    public function execute(Task $task, UpdateTaskDTO $dto): Task
    {
        return $this->tasks->update($task, $dto->toArray());
    }
}
