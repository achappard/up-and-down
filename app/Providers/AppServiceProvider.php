<?php

namespace App\Providers;

use App\Validators\MyValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('valid_distant_image', 'MyValidator@validateDistantImage');
    }


   /*public function validateDistantImage($attribute, $value, $parameters, $validator){
        return $value == 'foo';
    }*/



    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
