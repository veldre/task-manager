<?php

namespace App\Support\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/v1/tasks/{task}",
    summary: "Delete a task",
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
        new OA\Response(response: 204, description: "Task deleted"),
        new OA\Response(response: 404, description: "Task not found"),
    ]
)]
final class DeleteTask
{
}
