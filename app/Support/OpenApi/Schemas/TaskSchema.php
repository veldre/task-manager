<?php

namespace App\Support\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Task",
    type: "object",
    required: ["id", "title"],
    properties: [
        new OA\Property(
            property: "id",
            type: "integer",
            example: 1
        ),
        new OA\Property(
            property: "title",
            type: "string",
            example: "Buy milk"
        ),
        new OA\Property(
            property: "priority",
            type: "string",
            example: "high",
            nullable: true
        ),
        new OA\Property(
            property: "due_at",
            type: "string",
            format: "date",
            example: "2026-01-20",
            nullable: true
        ),
        new OA\Property(
            property: "created_at",
            type: "string",
            format: "date-time",
            example: "2026-01-20T10:15:30.000000Z",
            nullable: true
        ),
        new OA\Property(
            property: "updated_at",
            type: "string",
            format: "date-time",
            example: "2026-01-20T10:15:30.000000Z",
            nullable: true
        ),
    ]
)]
final class TaskSchema
{
}
