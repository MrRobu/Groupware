<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\Review' => 'App\Policies\ReviewPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Users
        Gate::resource('users', 'App\Policies\UserPolicy');
        Gate::define('users.attach-post', 'App\Policies\UserPolicy@attachPost');
        Gate::define('users.attach-review', 'App\Policies\UserPolicy@attachReview');

        // Posts
        Gate::resource('posts', 'App\Policies\PostPolicy');
        Gate::define('posts.see-in-list', 'App\Policies\PostPolicy@seeInList');
        Gate::define('posts.attach-review', 'App\Policies\PostPolicy@attachReview');
        
        // Reviews
        Gate::resource('reviews', 'App\Policies\ReviewPolicy');
    }
}
