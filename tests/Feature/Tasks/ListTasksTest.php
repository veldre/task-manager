<?php

namespace Tests\Feature\Tasks;

use App\Models\Task\Task;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTasksTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    private const API_ENDPOINT = '/api/v1/tasks';


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user, 'sanctum');
    }

    private function authenticate(): void
    {
        $this->actingAs($this->user, 'sanctum');
    }
    
    private function createUserTask(array $overrides = []): Task
    {
        return Task::factory()->create(array_merge([
            'user_id' => $this->user->id,
        ], $overrides));
    }


    public function test_tasks_endpoint_requires_authentication(): void
    {
        auth()->forgetGuards();

        $this->getJson(self::API_ENDPOINT)->assertStatus(401);
    }

    public function test_user_can_list_only_own_tasks(): void
    {
        $this->authenticate();

        // own tasks
        $task1 = $this->createUserTask();
        $task2 = $this->createUserTask();
        $task3 = $this->createUserTask();

        // foreign task
        $foreignTask = Task::factory()->create();

        $response = $this->getJson(self::API_ENDPOINT);

        $response->assertOk();

        $response->assertJsonStructure([
            'data',
            'links',
            'meta',
        ]);

        // only own tasks returned
        $ids = collect($response->json('data'))->pluck('id');

        $this->assertCount(3, $ids);
        $this->assertTrue($ids->contains($task1->id));
        $this->assertTrue($ids->contains($task2->id));
        $this->assertTrue($ids->contains($task3->id));
        $this->assertFalse($ids->contains($foreignTask->id));
    }
}
