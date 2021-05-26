<?php

namespace App\Providers;

use App\Models\PhieuXuat;
use App\Models\Team;
use App\Models\VaiTro;
use App\Policies\PhieuXuatPolicy;
use App\Policies\TeamPolicy;
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
        Team::class => TeamPolicy::class,
        PhieuXuat::class => PhieuXuatPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        // Gate::before(function($user) {
        //     if($user->id == 13) 
        //         return true; 
        // }); 
        if(!$this->app->runningInConsole()) {
            foreach(VaiTro::all() as $vaitro) {
                Gate::define($vaitro->TenVT, function($user) use ($vaitro) { 
                    $user->coVaiTro($vaitro);
                });
            }
        }
        //
    }
}
