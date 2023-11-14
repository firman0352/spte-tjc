<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('admin', function () {
            return "<?php if(auth()->user()->hasRole('admin')): ?>";
        });

        Blade::directive('endadmin', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('inspektur', function () {
            return "<?php if(auth()->user()->hasRole('inspektur')): ?>";
        });

        Blade::directive('endinspektur', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('customer', function () {
            return "<?php if(auth()->user()->hasRole('customer')): ?>";
        });

        Blade::directive('endcustomer', function () {
            return '<?php endif; ?>';
        });
    }
}
