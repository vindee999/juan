<?php

namespace App\Providers;

use App\Mail\UserMailChanged;
use App\Mail\Usercreated;
use App\Observers\ProductObserver;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        Product::observe(ProductObserver::class);

        User::created(function($user){
            retry(5,function() use ($user){
                Mail::to($user)->send(new Usercreated($user));
            },100);
        });

        User::updated(function($user){
            if($user->isDirty('email')){
                retry(5,function() use ($user){
                    Mail::to($user)->send(new UserMailChanged($user));
                },100);
            }
        });
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
