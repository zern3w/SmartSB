<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

       Validator::extend('alpha_spaces', function($attribute, $value)
       {
        return preg_match('/^[\pL\s]+$/u', $value);
    });
   }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         if ($this->app->environment() == 'local') {
        $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
    }
    }
}
