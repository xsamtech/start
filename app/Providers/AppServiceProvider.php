<?php

namespace App\Providers;

use App\Http\Resources\Category as ResourcesCategory;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProjectSector as ResourcesProjectSector;
use App\Http\Resources\User as ResourcesUser;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProjectSector;
use App\Models\User;
use App\Services\CartService;
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
    public function boot(CartService $cartService): void
    {
        Paginator::useBootstrap();

        view()->composer('*', function ($view) use ($cartService) {
            $sessionCartTotal = session()->has('cart') ? $cartService->getCartTotalFromSession() : 0;
            $current_user = null;

            if (Auth::check()) {
                $current_user = new ResourcesUser(Auth::user());
                $user_orders = $current_user->unpaidOrders();

                $view->with('user_orders', $user_orders);
            }

            $members = User::where('id', '<>', Auth::id())->whereHas('roles', function ($query) {
                                $query->where('role_name->fr', 'Membre');
                            })->orderByDesc('users.created_at')->paginate(5)->appends(request()->query());
            $sectors = ProjectSector::orderByDesc('created_at')->paginate(5)->appends(request()->query());
            $categories = Category::orderByDesc('created_at')->paginate(5)->appends(request()->query());
            $popular_projects = Product::mostOrdered(6, 'project', 'monthly');
            $popular_products = Product::mostOrdered(6, 'product', 'monthly');
            $popular_services = Product::mostOrdered(6, 'service', 'monthly');

            $view->with('members', ResourcesUser::collection($members)->resolve());
            $view->with('members_req', $members);
            $view->with('sectors', ResourcesProjectSector::collection($sectors)->resolve());
            $view->with('sectors_req', $sectors);
            $view->with('m_categories', ResourcesCategory::collection($categories)->resolve());
            $view->with('categories_req', $categories);
            $view->with('cartService', $cartService);
            $view->with('session_cart_total', $sessionCartTotal);
            $view->with('current_user', $current_user);
            $view->with('popular_projects', ResourcesProduct::collection($popular_projects)->resolve());
            $view->with('popular_products', ResourcesProduct::collection($popular_products)->resolve());
            $view->with('popular_services', ResourcesProduct::collection($popular_services)->resolve());
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
