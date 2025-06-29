<?php

namespace App\Providers;

use App\Http\Resources\User as ResourcesUser;
use App\Models\Product;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
            $current_user = null;

            if (Auth::check()) {
                $current_user = new ResourcesUser(Auth::user());
            }

            $products = Product::where('type', 'product')->limit(5)->orderBy('price', 'desc')->get();
            $services = Product::where('type', 'service')->limit(5)->orderBy('price', 'desc')->get();
            $projects = Product::where('type', 'project')->limit(5)->orderBy('price', 'desc')->get();

            $view->with('current_user', $current_user);
            $view->with('products', $products);
            $view->with('services', $services);
            $view->with('projects', $projects);
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
