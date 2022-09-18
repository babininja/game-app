<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models = [
            'User',
            'Question',
            'Game',
            'GameQuestion',
            'Answer',
        ];

        foreach ($models as $model) {
            $this->app->bind("App\Http\Repositories\Contracts\\{$model}RepositoryInterface",
                "App\Http\Repositories\Models\\{$model}Repository");
        }

        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
