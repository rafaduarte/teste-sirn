<?php

namespace App\Providers;

use App\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
       
        Paginator::useBootstrap(); 
            
         /**
         * Custom If Statements
         */
        Blade::if('admin', function (User $user) {
            $user = auth()->user(); 

            return $user->isAdmin();
        });
    }
}
