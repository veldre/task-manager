<?php

namespace App\Support\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Task Manager API",
    version: "1.0.0",
    description: "API for managing tasks"
)]
final class ApiInfo
{
}
