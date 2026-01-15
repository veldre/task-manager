<?php

namespace Tests\Feature\Tasks;

use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTasksTest extends TestCase
{
    use RefreshDatabase;

    private const API_ENDPOINT = '/api/v1/tasks';

    public function test_it_can_list_tasks_with_pagination(): void
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson(self::API_ENDPOINT);

        $response->assertOk();

        $response->assertJsonStructure([
            'data',
            'links',
            'meta',
        ]);

        $this->assertCount(3, $response->json('data'));
    }
}
