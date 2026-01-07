<?php

namespace App\Repositories\Tasks\Contracts;

use App\Models\Task\Task;

interface TaskRepositoryInterface
{
    public function create(array $data): Task;
}
