<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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

        $user = \Auth::user();

        Gate::define('menu_admin_access', function ($user) {
            return in_array($user->is_role, [1]);
        });

        Gate::define('menu_staff_access', function ($user) {
            return in_array($user->is_role, [2]);
        });
        Gate::define('menu_opr_access', function ($user) {
            return in_array($user->is_role, [3]);
        });
        Gate::define('menu_qa_access', function ($user) {
            return in_array($user->is_role, [4]);
        });
        Gate::define('menu_itsecruity_access', function ($user) {
            return in_array($user->is_role, [5]);
        });
    }
}
