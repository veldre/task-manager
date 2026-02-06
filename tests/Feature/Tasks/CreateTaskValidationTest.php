<?php

namespace Tests\Feature\Tasks;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateTaskValidationTest extends TestCase
{
    use RefreshDatabase;

    private const API_ENDPOINT = '/api/v1/tasks';


    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(User::factory()->create());
    }

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

    public function test_priority_is_required(): void
    {
        $payload = [
            'title' => 'Test task',
            'due_at' => now()->addDay()->toDateString(),
        ];

        $this->postJson(self::API_ENDPOINT, $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['priority']);
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

    public function test_title_must_be_a_string(): void
    {
        $payload = [
            'title' => 123,
            'priority' => 'high',
        ];

        $this->postJson(self::API_ENDPOINT, $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_due_at_must_be_a_valid_date(): void
    {
        $payload = [
            'title' => 'Test task',
            'priority' => 'high',
            'due_at' => 'not-a-date',
        ];

        $this->postJson(self::API_ENDPOINT, $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['due_at']);
    }

    public function test_due_at_must_not_be_in_the_past(): void
    {
        $payload = [
            'title' => 'Test task',
            'priority' => 'high',
            'due_at' => now()->subDay()->toDateString(),
        ];

        $this->postJson(self::API_ENDPOINT, $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['due_at']);
    }
}
