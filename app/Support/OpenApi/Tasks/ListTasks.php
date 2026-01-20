<?php

namespace App\Support\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/v1/tasks",
    summary: "List tasks",
    tags: ["Tasks"],
    responses: [
        new OA\Response(
            response: 200,
            description: "List of tasks",
            content: new OA\JsonContent(
                type: "array",
                items: new OA\Items(ref: "#/components/schemas/Task")
            )
        ),
    ]
)]
final class ListTasks
{
}
