<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Auth\ApiKeyGuard;

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
        
        // Register the custom API Key authentication guard
        Auth::extend('api_key_guard', function ($app, $name, array $config) {
            // Return an instance of our custom guard
            return new ApiKeyGuard(Auth::createUserProvider($config['provider']), $app['request']);
        });

        //
    }
}
