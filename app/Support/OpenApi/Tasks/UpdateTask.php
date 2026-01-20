<?php

namespace App\Support\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Patch(
    path: "/api/v1/tasks/{task}",
    summary: "Update a task",
    tags: ["Tasks"],
    parameters: [
        new OA\Parameter(
            name: "task",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "integer")
        ),
    ],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "title", type: "string"),
                new OA\Property(property: "description", type: "string", nullable: true),
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 200,
            description: "Task updated",
            content: new OA\JsonContent(ref: "#/components/schemas/Task")
        ),
        new OA\Response(response: 404, description: "Task not found"),
        new OA\Response(response: 422, description: "Validation error"),
    ]
)]
final class UpdateTask
{
}
