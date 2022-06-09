<?php

declare(strict_types=1);


namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Src\Task\Domain\Repositories\TaskRepository;
use Src\Task\Infrastructure\Persistence\TaskMYSQLRepository;

final class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TaskRepository::class, TaskMYSQLRepository::class);
    }
}
