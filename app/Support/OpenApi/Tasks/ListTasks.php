<?php

namespace App\Support\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/v1/tasks",
    summary: "List tasks",
    description: "Returns a list of all tasks",
    tags: ["Tasks"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Successful response"
        ),
    ]
)]
final class ListTasks
{
}
