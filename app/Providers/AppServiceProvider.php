<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\IGoalRepository;
use App\Repositories\GoalRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IGoalRepository::class, GoalRepository::class);
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
