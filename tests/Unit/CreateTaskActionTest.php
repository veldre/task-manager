<?php

namespace Tests\Unit\Tasks;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\DTO\CreateTaskDTO;
use App\Models\Task\Task;
use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;
use Mockery;
use Tests\TestCase;

class CreateTaskActionTest extends TestCase
{
    public function test_it_creates_task_using_repository(): void
    {
        $data = [
            'title' => 'Buy milk',
            'priority' => 'high',
            'due_at' => '2026-01-08',
        ];

        $dto = CreateTaskDTO::fromArray($data);

        $task = Task::make($data);

        $repo = Mockery::mock(TaskRepositoryInterface::class);
        $repo->shouldReceive('create')
            ->once()
            ->with($dto->toArray())
            ->andReturn($task);

        $action = new CreateTaskAction($repo);

        $result = $action->execute($dto);

        $this->assertInstanceOf(Task::class, $result);
        $this->assertSame('Buy milk', $result->title);
        $this->assertSame('high', $result->priority);
    }
}
