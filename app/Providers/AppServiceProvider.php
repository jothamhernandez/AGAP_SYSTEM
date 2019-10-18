<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Blade;

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
        //
        Schema::defaultStringLength(161);

        User::observe(UserObserver::class);

        Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });

        Blade::directive('generate_event_code', function ($event) {
            return "<?php echo substr(md5($event), 10, 5); ?>";
        });

        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
