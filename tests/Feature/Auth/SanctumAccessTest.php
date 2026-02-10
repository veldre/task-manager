<?php

namespace Tests\Feature\Auth;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SanctumAccessTest extends TestCase
{
    use RefreshDatabase;

    private const API_ENDPOINT = '/api/v1/tasks';

    public function test_protected_route_requires_sanctum_token(): void
    {
        $this->getJson(self::API_ENDPOINT)
            ->assertUnauthorized();
    }

    public function test_sanctum_token_allows_access_to_protected_route(): void
    {
        $user = User::factory()->create();

        $token = $user->createToken('test-token')->plainTextToken;

        $this
            ->withHeader('Authorization', 'Bearer '.$token)
            ->getJson(self::API_ENDPOINT)
            ->assertOk();
    }

    public function test_invalid_token_is_rejected(): void
    {
        $this
            ->withHeader('Authorization', 'Bearer invalid-token')
            ->getJson(self::API_ENDPOINT)
            ->assertUnauthorized();
    }
}
