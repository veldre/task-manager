<?php

namespace App\Providers;

use App\Repositories\Tasks\Contracts\TaskRepositoryInterface;
use App\Repositories\Tasks\DatabaseTaskRepository;
use Illuminate\Support\ServiceProvider;

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
