<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-article', function ($user, $article) {
            if (Auth::check()) {
                if (Auth::user()->isAdmin() || $user->id === $article->user_id) {
                    return true;
                } else {
                    return false;
                }
            }
        });


        Gate::define('edit-comment', function ($user, $comment) {
            if (Auth::check()) {
                if ($user->id === $comment->user_id) {
                    return true;
                } else {
                    return false;
                }
            }
        });

    }
}
