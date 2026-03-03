<?php

namespace App\Support\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/v1/auth/me',
    summary: 'Get current authenticated user',
    tags: ['Auth'],
    security: [['sanctum' => []]],
    responses: [
        new OA\Response(response: 200, description: 'Current user'),
        new OA\Response(response: 401, description: 'Unauthenticated'),
    ]
)]
final class Me
{
}
