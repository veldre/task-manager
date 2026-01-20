<?php

namespace App\Support\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/v1/tasks",
    summary: "Create a task",
    tags: ["Tasks"],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            required: ["title"],
            properties: [
                new OA\Property(property: "title", type: "string", example: "Buy milk"),
                new OA\Property(property: "description", type: "string", example: "2 liters"),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: "Task created"),
        new OA\Response(response: 422, description: "Validation error"),
    ]
)]
final class CreateTask
{
}
