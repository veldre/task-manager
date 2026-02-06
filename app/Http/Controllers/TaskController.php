<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\DeleteTaskAction;
use App\Actions\Tasks\DTO\CreateTaskDTO;
use App\Actions\Tasks\DTO\UpdateTaskDTO;
use App\Actions\Tasks\ListTasksAction;
use App\Actions\Tasks\UpdateTaskAction;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Request $request, ListTasksAction $listTasks): AnonymousResourceCollection
    {
        $tasks = $listTasks->execute($request->user());

        return TaskResource::collection($tasks);
    }

    public function show(Task $task): TaskResource
    {
        $this->authorize('view', $task);

        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request, CreateTaskAction $createTask): JsonResponse
    {
        $dto = CreateTaskDTO::fromArray($request->validated(), $request->user()->id);

        $task = $createTask->execute($dto);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Task $task, UpdateTaskRequest $request, UpdateTaskAction $updateTask): TaskResource
    {
        $this->authorize('update', $task);

        $dto = UpdateTaskDTO::fromArray($request->validated());

        $task = $updateTask->execute($task, $dto);

        return new TaskResource($task);
    }

    public function destroy(Task $task, DeleteTaskAction $deleteTask): Response
    {
        $this->authorize('delete', $task);

        $deleteTask->execute($task);

        return response()->noContent();
    }
}
