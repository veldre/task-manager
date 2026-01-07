<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Tasks\DatabaseTaskRepository;
use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, DatabaseTaskRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
