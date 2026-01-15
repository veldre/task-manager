<?php

namespace App\Repositories\Tasks\Contracts;

use App\Models\Task\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function create(array $data): Task;

    public function update(Task $task, array $data): Task;

    public function delete(Task $task): void;

    public function paginate(int $perPage = 15): LengthAwarePaginator;
}
