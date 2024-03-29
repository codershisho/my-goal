<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\IGoalRepository;
use App\Interfaces\IMtgRepository;
use App\Interfaces\ITermRepository;
use App\Interfaces\ITopicRepository;
use App\Interfaces\IUserRepository;
use App\Repositories\GoalRepository;
use App\Repositories\MtgRepository;
use App\Repositories\TermRepository;
use App\Repositories\TopicRepository;
use App\Repositories\UserRepository;

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
        $this->app->bind(IMtgRepository::class, MtgRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ITermRepository::class, TermRepository::class);
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
