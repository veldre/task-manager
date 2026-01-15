<?php

namespace Tests\Feature\Tasks;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTaskValidationTest extends TestCase
{
    use RefreshDatabase;

    private const API_ENDPOINT = '/api/v1/tasks';


    public function test_title_is_required(): void
    {
        $payload = [
            'priority' => 'high',
            'due_at' => now()->addDay()->toDateString(),
        ];

        $this->postJson(self::API_ENDPOINT, $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_priority_must_be_valid(): void
    {
        $payload = [
            'title' => 'Buy milk',
            'priority' => 'super-high',
        ];

        $this->postJson(self::API_ENDPOINT, $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['priority']);
    }
}
