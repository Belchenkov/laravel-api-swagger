<?php

namespace App\Ship\Core\Providers;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Repositories\Contracts\IUser;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IUser::class, UserRepository::class);
    }
}
