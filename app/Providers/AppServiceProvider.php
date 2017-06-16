<?php

namespace App\Providers;


use App\TestB;
use Illuminate\Support\Facades\DB;
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
        //

        $this->app->bind('App\TestB', function($app){
            return new TestB($app->make('App\TestA'));
        });


        // Listening For Query Events
        /*DB::listen(function($query){
            dd($query);
        });*/

    }

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
