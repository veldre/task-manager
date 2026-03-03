<?php

namespace App\Support\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/v1/tasks',
    security: [['sanctum' => []]],
    summary: 'Create a task',
    tags: ['Tasks'],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['title', 'priority'],
            properties: [
                new OA\Property(
                    property: 'title',
                    type: 'string',
                    minLength: 3,
                    maxLength: 255,
                    example: 'Buy milk'
                ),
                new OA\Property(
                    property: 'priority',
                    type: 'string',
                    enum: ['low', 'medium', 'high'],
                    example: 'medium'
                ),
                new OA\Property(
                    property: 'due_at',
                    type: 'string',
                    format: 'date',
                    example: '2026-03-05',
                    nullable: true
                ),
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: 'Task created',
            content: new OA\JsonContent(
                ref: '#/components/schemas/Task'
            )
        ),
        new OA\Response(response: 422, description: 'Validation error'),
        new OA\Response(response: 401, description: 'Unauthenticated'),
    ]
)]
final class CreateTask
{
}
