<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
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

        // Passport::tokensExpireIn(Carbon::now()->addDays(15)); //应该是保存15天
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30)); //30分钟       

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30)); //生成的时间是30
    }
}
