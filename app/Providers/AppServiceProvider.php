<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Notifiable;
use App\Models\Todo;
use App\Policies\TodoPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Todo::class => TodoPolicy::class,
    ];

    // use Notifiable;

    // public function todos(){
    //     return $this->hasMany(Todo::class);
    // }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
