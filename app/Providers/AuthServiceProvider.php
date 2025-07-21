<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Post;
use App\Models\Review;
use App\Policies\PostPolicy;
use App\Policies\ReviewPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Post::class => PostPolicy::class,
        Review::class => ReviewPolicy::class,
        // Example:
        // \App\Models\Post::class => \App\Policies\PostPolicy::class,
    ];

    /**
     * Bootstrap any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Example Gate
        // Gate::define('edit-post', fn ($user, $post) => $user->id === $post->user_id);
    }
}
