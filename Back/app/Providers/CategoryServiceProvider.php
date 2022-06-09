<?php

declare(strict_types=1);


namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Src\Category\Domain\Repositories\CategoryRepository;
use Src\Category\Infrastructure\Persistence\CategoryMYSQLRepository;

final class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryMYSQLRepository::class);
    }
}
