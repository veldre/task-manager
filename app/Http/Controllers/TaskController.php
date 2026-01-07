<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\DTO\CreateTaskDTO;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request, CreateTaskAction $createTask): JsonResponse
    {
        $dto = CreateTaskDTO::fromArray($request->validated());

        $task = $createTask->execute($dto);

        return response()->json(['id' => $task->id], 201);
    }
}
