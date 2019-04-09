<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

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
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        $gate->define('isAdmin',function($user){
            return Auth::guard('admin')->check();
        });
        
        $gate->define('isPimpinan',function($user){
            return $user->level_user =='pimpinan';
        });

        $gate->define('isStafTu',function($user){
            return $user->level_user =='staf_tu';
        });
    }
}
