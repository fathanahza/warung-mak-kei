<?php

namespace App\Providers;

use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind services as singletons
        $this->app->singleton(ImageService::class);
        $this->app->singleton(ProductService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gunakan custom pagination view
        Paginator::defaultView('components.public.pagination');
        Paginator::defaultSimpleView('components.public.pagination');

        // Blade directive @rupiah
        Blade::directive('rupiah', function (string $expression) {
            return "<?php echo 'Rp ' . number_format({$expression}, 0, ',', '.'); ?>";
        });

        // Blade directive @starRating
        Blade::directive('starRating', function (string $expression) {
            return "<?php echo star_rating({$expression}); ?>";
        });

        // Share wishlist count to all views
        view()->composer('*', function ($view) {
            $view->with('_wishlistCount', count(session()->get('wishlist', [])));
        });
    }
}
