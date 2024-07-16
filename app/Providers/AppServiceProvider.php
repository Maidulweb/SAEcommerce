<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Models\SmtpConfiguration;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
    public function boot(): void
    {
        Paginator::useBootstrap();

        $generalSetting = GeneralSetting::first();

        Config::set('app.timezone', $generalSetting->timezone);
        
        $smtp = SmtpConfiguration::first();

        Config::set('mail.mailers.smtp.host', $smtp->host);
        Config::set('mail.mailers.smtp.port', $smtp->port);
        Config::set('mail.mailers.smtp.encryption', $smtp->encryption);
        Config::set('mail.mailers.smtp.username', $smtp->username);
        Config::set('mail.mailers.smtp.password', $smtp->password);
        Config::set('mail.from.address', $smtp->email);

        View::composer('*',function($view) use ($generalSetting){
              $view->with('setting', $generalSetting);
        });
    }
}
