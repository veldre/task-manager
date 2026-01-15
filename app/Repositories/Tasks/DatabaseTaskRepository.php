<?php

namespace App\Repositories\Tasks;

use App\Models\Task\Task;
use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DatabaseTaskRepository implements TaskRepositoryInterface
{
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);

        return $task->refresh();
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
   
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Task::latest('id')->paginate($perPage);
    }
}
