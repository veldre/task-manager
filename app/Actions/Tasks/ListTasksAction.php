<?php

namespace App\Actions\Tasks;

use App\Models\User\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListTasksAction
{
    public function execute(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return $user->tasks()->latest()->paginate($perPage);
    }
}
