<?php

namespace App\Support\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/v1/auth/login',
    summary: 'Login user',
    tags: ['Auth'],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['email', 'password'],
            properties: [
                new OA\Property(property: 'email', type: 'string', example: 'user@example.com'),
                new OA\Property(property: 'password', type: 'string', example: 'password'),
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 200,
            description: 'Login successful',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'token', type: 'string', example: '1|xxxxxxxxxxxxxxxxxxxx'),
                ]
            )
        ),
        new OA\Response(response: 422, description: 'Validation error'),
        new OA\Response(response: 401, description: 'Invalid credentials'),
    ]
)]
final class LoginUser
{
}
