<?php

namespace App\Support\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/v1/auth/register',
    summary: 'Register user',
    tags: ['Auth'],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['name', 'email', 'password'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
                new OA\Property(property: 'email', type: 'string', example: 'user@example.com'),
                new OA\Property(property: 'password', type: 'string', example: 'password'),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: 'User registered'),
        new OA\Response(response: 422, description: 'Validation error'),
    ]
)]
final class RegisterUser
{
}
