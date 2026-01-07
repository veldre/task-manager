<?php

namespace App\Actions\Tasks;

use App\Actions\Tasks\DTO\CreateTaskDTO;
use App\Models\Task\Task;
use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;

class CreateTaskAction
{
    public function __construct(private TaskRepositoryInterface $tasks)
    {
    }

    public function execute(CreateTaskDTO $dto): Task
    {
        return $this->tasks->create($dto->toArray());
    }
}
