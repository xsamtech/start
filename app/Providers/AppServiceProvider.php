<?php

namespace App\Providers;

use App\Http\Resources\Product as ResourcesProduct;
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

            $popular_products = Product::mostOrdered(10, 'monthly');
            $recent_investors = User::whereHas('roles', function ($query) {
                                    $query->where('role_name->fr', 'Investisseur');
                                })->orderByDesc('users.created_at')->take(10)->get();

            $view->with('current_user', $current_user);
            $view->with('popular_products', ResourcesProduct::collection($popular_products)->resolve());
            $view->with('recent_investors', ResourcesUser::collection($recent_investors)->resolve());
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
