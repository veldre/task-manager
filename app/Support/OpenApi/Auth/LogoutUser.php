<?php

namespace App\Support\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/v1/auth/logout',
    summary: 'Logout user (revoke current token)',
    tags: ['Auth'],
    security: [['sanctum' => []]],
    responses: [
        new OA\Response(response: 204, description: 'Logged out'),
        new OA\Response(response: 401, description: 'Unauthenticated'),
    ]
)]
final class LogoutUser
{
}
