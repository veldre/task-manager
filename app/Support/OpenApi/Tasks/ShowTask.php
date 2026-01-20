<?php

namespace App\Support\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/v1/tasks/{task}",
    summary: "Get a single task",
    tags: ["Tasks"],
    parameters: [
        new OA\Parameter(
            name: "task",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "integer")
        ),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Task found",
            content: new OA\JsonContent(ref: "#/components/schemas/Task")
        ),
        new OA\Response(response: 404, description: "Task not found"),
    ]
)]
final class ShowTask
{
}
