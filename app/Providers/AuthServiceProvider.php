<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Post;
use App\Models\Testblock;
use App\Models\Worldtc;
use App\Models\Collection;
use App\Models\Customerservice;
use App\Models\Findus;
use App\Models\Ordercatalogue;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Testblock::class => PostPolicy::class,
        Worldtc::class => PostPolicy::class,
        Collection::class => PostPolicy::class,
        Customerservice::class => PostPolicy::class,
        Findus::class => PostPolicy::class,
        Ordercatalogue::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies($gate);
    }
}
