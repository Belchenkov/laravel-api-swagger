<?php

namespace App\Ship\Core\Providers;

use App\Containers\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        \Gate::define('view', function (User $user, string $model) {
           return $user->hasAccess('view_' . $model) || $user->hasAccess('edit_' . $model);
        });
        \Gate::define('view', function (User $user, string $model) {
           return $user->hasAccess('edit_' . $model);
        });
    }
}
