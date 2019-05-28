<?php

namespace Dean\Login;

use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Login $extension)
    {
        if (!Login::boot()) {
            return;
        }
        
        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'dean');
        }
        
        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/dean/login')],
                'dean-login'
            );
        }
        
        $this->app->booted(function () {
            Login::routes(__DIR__ . '/../routes/web.php');
        });
    }
    
}