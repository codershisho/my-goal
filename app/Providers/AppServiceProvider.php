<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\IGoalRepository;
use App\Interfaces\ITopicRepository;
use App\Repositories\GoalRepository;
use App\Repositories\TopicRepository;

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
        $this->app->bind(ITopicRepository::class, TopicRepository::class);
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
