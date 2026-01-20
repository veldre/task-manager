<?php

namespace Database\Seeders;

use App\Models\Task\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    public function run(): void
    {
        Task::factory()->count(10)->create();
    }
}
