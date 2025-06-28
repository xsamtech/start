<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
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

        view()->composer('*', function ($view) {
            $products = Product::where('type', 'product')->orderByDesc('created_at')->limit(5)->get();
            $services = Product::where('type', 'service')->orderByDesc('created_at')->limit(5)->get();
            $projects = Product::where('type', 'project')->orderByDesc('created_at')->limit(5)->get();

            $view->with('products', $products);
            $view->with('services', $services);
            $view->with('projects', $projects);
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
