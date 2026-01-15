<?php

namespace App\Actions\Tasks;

use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListTasksAction
{
    public function __construct(private TaskRepositoryInterface $tasks)
    {
    }

    public function execute(int $perPage = 15): LengthAwarePaginator
    {
        return $this->tasks->paginate($perPage);
    }
}
