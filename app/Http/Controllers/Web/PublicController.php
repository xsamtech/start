<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\ApiClientManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\Crowdfunding as ResourcesCrowdfunding;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\User as ResourcesUser;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Crowdfunding;
use App\Models\File;
use App\Models\PaidFund;
use App\Models\Post;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class PublicController extends Controller
{
    public static $api_client_manager;

    public function __construct()
    {
        $this::$api_client_manager = new ApiClientManager();
    }

    // ==================================== HTTP GET METHODS ====================================
    /**
     * GET: Change language
     *
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }

    /**
     * GET: Change language
     *
     * @param  string  $currency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeCurrency($currency)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->back();
        }

        $user->update(['currency' => $currency]);

        return redirect()->back();
    }

    /**
     * GET: Home page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * GET: Create symbolic link
     *
     * @return \Illuminate\View\View
     */
    public function symlink()
    {
        return view('symlink');
    }

    /**
     * GET: Search something
     * 
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $per_page = $request->get('per_page', 15);
        $filters = $request->only(['category_id', 'user_id', 'type', 'action']);
        // Request
        $products = Product::searchWithFilters($query, $filters, $per_page);

        return view('search', ['products' => $products]);
    }

    /**
     * GET: Create symbolic link
     *
     * @return \Illuminate\View\View
     */
    public function cart()
    {
        $cartItems = session()->get('cart', []);

        return view('cart', ['items' => $cartItems]);
    }

    /**
     * GET: Account page
     *
     * @return \Illuminate\View\View
     */
    public function account()
    {
        return view('account');
    }

    /**
     * GET: User profile page
     *
     * @return \Illuminate\View\View
     */
    public function profile($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return redirect('/')->with('error_message', __('notifications.find_user_404'));
        }

        return view('profile', ['user' => $user]);
    }

    /**
     * GET: Account page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $entity
     * @return \Illuminate\View\View
     */
    public function accountEntity(Request $request, $entity)
    {
        $current_user = User::find(Auth::id());
        $entity_title = null;
        $cart = null;
        $category = null;
        $categories = null;
        $items = null;

        if ($entity == 'cart') {
            $entity_title = __('miscellaneous.menu.account.cart');
            // Get user unpaid cart
            $cart = $current_user->unpaidCart()->first();
            // Get user unpaid orders
            $items = $current_user->unpaidOrders();
        }

        if ($entity == 'projects') {
            $entity_title = __('miscellaneous.menu.account.project.title');
            $categories = Category::withCount('products')->where('for_service', 2)->get();

            if ($categories->isEmpty()) {
                Category::create([
                    'category_name' => [
                        'en' => 'Processing plant',
                        'fr' => 'Usine de transformation'
                    ],
                    'category_description' => [
                        'en' => 'Industrial establishment that transforms agricultural raw materials into finished or semi-finished products.',
                        'fr' => 'Etablissement industriel qui transforme les matières premières agricoles en produits finis ou semi-finis.'
                    ],
                    'for_service' => 2,
                    'alias' => 'processing-plant',
                ]);
            }

            $categories_ids = $categories->pluck('id')->toArray();

            // If $categories_ids is empty, we have a problem
            $categoryId = $request->category_id ?? ($categories_ids[0] ?? null);

            if ($categoryId === null) {
                return redirect()->route('home')->with('error_message', __('notifications.find_category_404'));
            }

            // Get the first category in the case user has not yet selected his category
            $category = Category::where([['id', $categoryId], ['for_service', 2]])->first();
            // Get user projects
            $query = Product::where([['type', 'project'], ['category_id', $categoryId], ['user_id', $current_user->id]]);
            $items = $query->orderByDesc('updated_at')->paginate(12)->appends($request->query());

            // Ajouter la méthode convertPrice au résultat paginé
            $items->getCollection()->transform(function ($item) use ($current_user) {
                // Ajouter la méthode convertPrice() avec la devise de l'utilisateur
                $item->converted_price = $item->convertPrice($current_user->currency); // Devise de l'utilisateur

                return $item;
            });
        }

        if ($entity == 'products') {
            $entity_title = __('miscellaneous.menu.account.product.title');
            $categories = Category::withCount('products')->where('for_service', 0)->get();

            if ($categories->isEmpty()) {
                Category::create([
                    'category_name' => [
                        'en' => 'Cash crops',
                        'fr' => 'Cultures de rente'
                    ],
                    'category_description' => [
                        'en' => 'Coffee, Oil palm, Rubber, Cocoa, Rice, Tea.',
                        'fr' => 'Café, Palmier à huile, Caoutchouc, Cacao, Riz, Thé.'
                    ],
                    'for_service' => 0,
                    'alias' => 'cash-crops',
                ]);
            }

            $categories_ids = $categories->pluck('id')->toArray();

            // If $categories_ids is empty, we have a problem
            $categoryId = $request->category_id ?? ($categories_ids[0] ?? null);

            if ($categoryId === null) {
                return redirect()->route('home')->with('error_message', __('notifications.find_category_404'));
            }

            // Get the first category in the case user has not yet selected his category
            $category = Category::where([['id', $categoryId], ['for_service', 0]])->first();
            // Get user products
            $query = Product::where([['type', 'product'], ['category_id', $categoryId], ['user_id', $current_user->id]]);

            // Sort by "action" if needed
            $query->when($request->action, function ($query) use ($request) {
                return $query->where('action', $request->action);
            });

            // Filter by price if values ​​are passed in the query
            $fromPrice = $request->input('from_price', 0);
            $toPrice = $request->input('to_price', 999999);

            if ($fromPrice > $toPrice) {
                return redirect()->back()->with('error_message', __('notifications.min_max_price_error'));
            }

            // Add price filter to query
            $query->whereBetween('price', [$fromPrice, $toPrice]);

            $items = $query->orderByDesc('updated_at')->paginate(12)->appends($request->query());

            // Ajouter la méthode convertPrice au résultat paginé
            $items->getCollection()->transform(function ($item) use ($current_user) {
                // Ajouter la méthode convertPrice() avec la devise de l'utilisateur
                $item->converted_price = $item->convertPrice($current_user->currency); // Devise de l'utilisateur

                return $item;
            });
        }

        if ($entity == 'services') {
            $entity_title = __('miscellaneous.menu.account.service.title');
            $categories = Category::withCount('products')->where('for_service', 1)->get();

            if ($categories->isEmpty()) {
                Category::create([
                    'category_name' => [
                        'en' => 'Manufacturing and processing',
                        'fr' => 'Fabrication et transformation'
                    ],
                    'category_description' => [
                        'en' => 'Set of operations that enable raw materials from agriculture to be transformed into finished or semi-finished products.',
                        'fr' => 'Ensemble des opérations qui permettent de transformer les matières premières issues de l\'agriculture en produits finis ou semi-finis.'
                    ],
                    'for_service' => 1,
                    'alias' => 'manufacturing-processing',
                ]);
            }

            $categories_ids = $categories->pluck('id')->toArray();

            // If $categories_ids is empty, we have a problem
            $categoryId = $request->category_id ?? ($categories_ids[0] ?? null);

            if ($categoryId === null) {
                return redirect()->route('home')->with('error_message', __('notifications.find_category_404'));
            }

            // Get the first category in the case user has not yet selected his category
            $category = Category::where([['id', $categoryId], ['for_service', 1]])->first();
            // Get user services
            $query = Product::where([['type', 'service'], ['category_id', $categoryId], ['user_id', $current_user->id]]);

            // Sort by "action" if needed
            $query->when($request->action, function ($query) use ($request) {
                return $query->where('action', $request->action);
            });

            // Filter by price if values ​​are passed in the query
            $fromPrice = $request->input('from_price', 0);
            $toPrice = $request->input('to_price', 999999);

            if ($fromPrice > $toPrice) {
                return redirect()->back()->with('error_message', __('notifications.min_max_price_error'));
            }

            // Add price filter to query
            $query->whereBetween('price', [$fromPrice, $toPrice]);

            $items = $query->orderByDesc('updated_at')->paginate(12)->appends($request->query());

            // Ajouter la méthode convertPrice au résultat paginé
            $items->getCollection()->transform(function ($item) use ($current_user) {
                // Ajouter la méthode convertPrice() avec la devise de l'utilisateur
                $item->converted_price = $item->convertPrice($current_user->currency); // Devise de l'utilisateur

                return $item;
            });
        }

        return view('account', [
            'entity' => $entity,
            'entity_title' => $entity_title,
            'cart' => $cart,
            'category' => $category,
            'categories' => $categories,
            'items' => $items,
            'countries' => showCountries()
        ]);
    }

    /**
     * GET: Products page
     *
     * @return \Illuminate\View\View
     */
    public function products()
    {
        return view('products');
    }

    /**
     * GET: Product entity page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $entity
     * @return \Illuminate\View\View
     */
    public function productEntity(Request $request, $entity)
    {
        $entity_title = null;
        $category = null;
        $categories = null;
        $items = null;

        if ($entity == 'project') {
            $entity_title = __('miscellaneous.menu.admin.categories.projects');
            $categories = Category::withCount('products')->where('for_service', 2)->get();

            if ($categories->isEmpty()) {
                Category::create([
                    'category_name' => [
                        'en' => 'Processing plant',
                        'fr' => 'Usine de transformation'
                    ],
                    'category_description' => [
                        'en' => 'Industrial establishment that transforms agricultural raw materials into finished or semi-finished products.',
                        'fr' => 'Etablissement industriel qui transforme les matières premières agricoles en produits finis ou semi-finis.'
                    ],
                    'for_service' => 2,
                    'alias' => 'processing-plant',
                ]);
            }

            $categories_ids = $categories->pluck('id')->toArray();

            // If $categories_ids is empty, we have a problem
            $categoryId = $request->category_id ?? ($categories_ids[0] ?? null);

            if ($categoryId === null) {
                return redirect()->route('home')->with('error_message', __('notifications.find_category_404'));
            }

            // Get the first category in the case user has not yet selected his category
            $category = Category::where([['id', $categoryId], ['for_service', 2]])->first();
            // Get user projects
            $query = Product::where([['type', 'project'], ['category_id', $categoryId]]);
            $items = $query->orderByDesc('updated_at')->paginate(12)->appends($request->query());

            if (Auth::check()) {
                $current_user = User::find(Auth::id());

                // Ajouter la méthode convertPrice au résultat paginé
                $items->getCollection()->transform(function ($item) use ($current_user) {
                    // Ajouter la méthode convertPrice() avec la devise de l'utilisateur
                    $item->converted_price = $item->convertPrice($current_user->currency); // Devise de l'utilisateur

                    return $item;
                });
            }
        }

        if ($entity == 'product') {
            $entity_title = __('miscellaneous.menu.public.products.products');
            $categories = Category::withCount('products')->where('for_service', 0)->get();

            if ($categories->isEmpty()) {
                Category::create([
                    'category_name' => [
                        'en' => 'Cash crops',
                        'fr' => 'Cultures de rente'
                    ],
                    'category_description' => [
                        'en' => 'Coffee, Oil palm, Rubber, Cocoa, Rice, Tea.',
                        'fr' => 'Café, Palmier à huile, Caoutchouc, Cacao, Riz, Thé.'
                    ],
                    'for_service' => 0,
                    'alias' => 'cash-crops',
                ]);
            }

            $categories_ids = $categories->pluck('id')->toArray();

            // If $categories_ids is empty, we have a problem
            $categoryId = $request->category_id ?? ($categories_ids[0] ?? null);

            if ($categoryId === null) {
                return redirect()->route('home')->with('error_message', __('notifications.find_category_404'));
            }

            // Get the first category in the case user has not yet selected his category
            $category = Category::where([['id', $categoryId], ['for_service', 0]])->first();
            // Get user products
            $query = Product::where([['type', 'product'], ['category_id', $categoryId]]);

            // Sort by "action" if needed
            $query->when($request->action, function ($query) use ($request) {
                return $query->where('action', $request->action);
            });

            // Filter by price if values ​​are passed in the query
            $fromPrice = $request->input('from_price', 0);
            $toPrice = $request->input('to_price', 999999);

            if ($fromPrice > $toPrice) {
                return redirect()->back()->with('error_message', __('notifications.min_max_price_error'));
            }

            // Add price filter to query
            $query->whereBetween('price', [$fromPrice, $toPrice]);

            $items = $query->orderByDesc('updated_at')->paginate(12)->appends($request->query());

            if (Auth::check()) {
                $current_user = User::find(Auth::id());

                // Ajouter la méthode convertPrice au résultat paginé
                $items->getCollection()->transform(function ($item) use ($current_user) {
                    // Ajouter la méthode convertPrice() avec la devise de l'utilisateur
                    $item->converted_price = $item->convertPrice($current_user->currency); // Devise de l'utilisateur

                    return $item;
                });
            }
        }

        if ($entity == 'service') {
            $entity_title = __('miscellaneous.menu.public.products.services');
            $categories = Category::withCount('products')->where('for_service', 1)->get();

            if ($categories->isEmpty()) {
                Category::create([
                    'category_name' => [
                        'en' => 'Manufacturing and processing',
                        'fr' => 'Fabrication et transformation'
                    ],
                    'category_description' => [
                        'en' => 'Set of operations that enable raw materials from agriculture to be transformed into finished or semi-finished products.',
                        'fr' => 'Ensemble des opérations qui permettent de transformer les matières premières issues de l\'agriculture en produits finis ou semi-finis.'
                    ],
                    'for_service' => 1,
                    'alias' => 'manufacturing-processing',
                ]);
            }

            $categories_ids = $categories->pluck('id')->toArray();

            // If $categories_ids is empty, we have a problem
            $categoryId = $request->category_id ?? ($categories_ids[0] ?? null);

            if ($categoryId === null) {
                return redirect()->route('home')->with('error_message', __('notifications.find_category_404'));
            }

            // Get the first category in the case user has not yet selected his category
            $category = Category::where([['id', $categoryId], ['for_service', 1]])->first();
            // Get user services
            $query = Product::where([['type', 'service'], ['category_id', $categoryId]]);

            // Sort by "action" if needed
            $query->when($request->action, function ($query) use ($request) {
                return $query->where('action', $request->action);
            });

            // Filter by price if values ​​are passed in the query
            $fromPrice = $request->input('from_price', 0);
            $toPrice = $request->input('to_price', 999999);

            if ($fromPrice > $toPrice) {
                return redirect()->back()->with('error_message', __('notifications.min_max_price_error'));
            }

            // Add price filter to query
            $query->whereBetween('price', [$fromPrice, $toPrice]);

            $items = $query->orderByDesc('updated_at')->paginate(12)->appends($request->query());

            if (Auth::check()) {
                $current_user = User::find(Auth::id());

                // Ajouter la méthode convertPrice au résultat paginé
                $items->getCollection()->transform(function ($item) use ($current_user) {
                    // Ajouter la méthode convertPrice() avec la devise de l'utilisateur
                    $item->converted_price = $item->convertPrice($current_user->currency); // Devise de l'utilisateur

                    return $item;
                });
            }
        }

        return view('products', [
            'entity' => $entity,
            'entity_title' => $entity_title,
            'category' => $category,
            'categories' => $categories,
            'items' => $items,
        ]);
    }

    /**
     * GET: Product details
     *
     * @param  string  $entity
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function productDatas($entity, $id)
    {
        $entity_title = null;
        $selected_product = Product::find($id);

        if (is_null($selected_product)) {
            return redirect('/')->with('error_message', __('notifications.find_product_404'));
        }

        if ($entity == 'project') {
            $entity_title = __('miscellaneous.menu.public.products.about_project');
        }

        if ($entity == 'product') {
            $entity_title = __('miscellaneous.menu.public.products.about_product');
        }

        if ($entity == 'service') {
            $entity_title = __('miscellaneous.menu.public.products.about_service');
        }

        return view('products', [
            'entity_title' => $entity_title,
            'entity' => $entity,
            'selected_product' => $selected_product,
        ]);
    }

    /**
     * GET: Posts page
     *
     * @return \Illuminate\View\View
     */
    public function discussions()
    {
        $posts = request()->has('category_id') ? Post::where([['for_category_id', request()->get('category_id')], ['type', 'post']])->orderByDesc('created_at')->paginate(5)->appends(request()->query()) : Post::where('type', 'post')->orderByDesc('created_at')->paginate(5)->appends(request()->query());
        $project_categories = Category::where('for_service', 2)->get();
        $product_categories = Category::where('for_service', 0)->get();
        $service_categories = Category::where('for_service', 1)->get();

        return view('discussions', [
            'posts' => ResourcesPost::collection($posts),
            'posts_req' => $posts,
            'posts_req_currentPage' => $posts->currentPage(),
            'posts_req_lastPage' => $posts->lastPage(),
            'posts_req_total' => $posts->total(),
            'project_categories' => $project_categories,
            'product_categories' => $product_categories,
            'service_categories' => $service_categories,
        ]);
    }

    /**
     * GET: Post details
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function discussionDatas($id)
    {
        $entity_title = __('miscellaneous.admin.post.details');
        $selected_post = Post::find($id);

        if (is_null($selected_post)) {
            return redirect('/')->with('error_message', __('notifications.find_error'));
        }

        $related_posts = Post::where([['id', '<>', $selected_post->id], ['for_category_id', '=', $selected_post->for_category_id]])->take(3)->get();
        $project_categories = Category::where('for_service', 2)->get();
        $product_categories = Category::where('for_service', 0)->get();
        $service_categories = Category::where('for_service', 1)->get();

        return view('discussions', [
            'entity_title' => $entity_title,
            'selected_post' => $selected_post,
            'related_posts' => ResourcesPost::collection($related_posts),
            'project_categories' => $project_categories,
            'product_categories' => $product_categories,
            'service_categories' => $service_categories,
        ]);
    }

    /**
     * GET: Investors page
     *
     * @return \Illuminate\View\View
     */
    public function investors()
    {
        $investors = Auth::check() ? User::where('id', '<>', Auth::id())->whereHas('roles', function ($query) {
                                            $query->where('role_name->fr', 'Investisseur');
                                        })->orderByDesc('users.created_at')->paginate(12)->appends(request()->query())
                                    : User::whereHas('roles', function ($query) {
                                        $query->where('role_name->fr', 'Investisseur');
                                    })->orderByDesc('users.created_at')->paginate(12)->appends(request()->query());

        $role_investor = null;
        $role_investor_exists = Role::where('role_name->fr', 'Investisseur')->exists();

        if (!$role_investor_exists) {
            $role_investor = Role::create([
                'role_name' => [
                    'en' => 'Investor',
                    'fr' => 'Investisseur',
                ],
                'role_description' => [
                    'en' => 'A person who invests their money in a project on the platform.',
                    'fr' => 'Personne qui investit son argent pour un projet sur la plateforme.',
                ]
            ]);
        }

        $role_investor = Role::where('role_name->fr', 'Investisseur')->first();

        return view('investors', [
            'role_investor' => $role_investor,
            'investors' => ResourcesUser::collection($investors),
            'investors_req' => $investors,
            'investors_req_currentPage' => $investors->currentPage(),
            'investors_req_lastPage' => $investors->lastPage(),
            'investors_req_total' => $investors->total(),
        ]);
    }

    /**
     * GET: Investor details
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function investorDatas($id)
    {
        $entity_title = __('miscellaneous.admin.investor.details');
        $investor_role_id = Role::where('role_name->fr', 'Investisseur')->first()->id;
        $selected_investor = User::find($id);

        if (is_null($selected_investor)) {
            return redirect('/')->with('error_message', __('notifications.find_investor_404'));
        }

        if (!$selected_investor->roles->contains('id', $investor_role_id)) {
            return redirect('/')->with('error_message', __('notifications.find_error'));
        }

        return view('investors', [
            'entity_title' => $entity_title,
            'selected_investor' => $selected_investor,
        ]);
    }

    /**
     * GET: Crowdfundings page
     *
     * @return \Illuminate\View\View
     */
    public function crowdfunding()
    {
        $crowdfundings = Crowdfunding::orderByDesc('created_at')->paginate(8)->appends(request()->query());

        // Ajouter le taux de financement à chaque crowdfunding
        $crowdfundings->getCollection()->transform(function ($crowdfunding) {
            $currency = (Auth::check() ? Auth::user()->currency : $crowdfunding->currency);
            $crowdfunding->financing_rate = $crowdfunding->financingRate($currency);

            return $crowdfunding;
        });

        return view('crowdfundings', [
            'crowdfundings' => ResourcesCrowdfunding::collection($crowdfundings)->resolve(),
            'crowdfundings_req' => $crowdfundings,
        ]);
    }

    /**
     * GET: Crowdfunding details
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function crowdfundingDatas($id)
    {
        $entity_title = __('miscellaneous.admin.crowdfunding.details');
        $selected_crowdfunding = Crowdfunding::find($id);

        if (is_null($selected_crowdfunding)) {
            return redirect('/crowdfunding')->with('error_message', __('notifications.find_error'));
        }

        return view('crowdfundings', [
            'entity_title' => $entity_title,
            'selected_crowdfunding' => (new ResourcesCrowdfunding($selected_crowdfunding))->resolve(),
            'countries' => showCountries(),
        ]);
    }

    // ==================================== HTTP DELETE METHODS ====================================
    /**
     * GET: Delete something
     *
     * @param  string $entity
     * @param  int $id
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function removeData($entity, $id)
    {
        if ($entity == 'product') {
            $product = Product::find($id);

            if (!$product) {
                return redirect(RouteServiceProvider::HOME)->with('error_message', __('notifications.find_error'));
            }

            $filesToDelete = File::where('product_id', $product->id)->get();

            foreach ($filesToDelete as $file) {
                // Delete the file from the file system
                $relativeStoragePath = str_replace(getWebURL() . '/storage/', '', $file->file_url);

                Storage::disk('public')->delete($relativeStoragePath);

                // Deletes the row at the database
                $file->delete();
            }

            $product->delete();

            return redirect('/products/' . $product->type)->with('success_message', __('notifications.deleted_data'));
        }

        if ($entity == 'cart') {
            $cart = Cart::find($id);

            if (!$cart) {
                return redirect(RouteServiceProvider::HOME)->with('error_message', __('notifications.find_error'));
            }

            $cart->delete();

            return redirect('/account')->with('success_message', __('notifications.deleted_data'));
        }
    }

    /**
     * Display the message about transaction in waiting.
     *
     * @return \Illuminate\View\View
     */
    public function transactionWaiting()
    {
        return view('transaction_message');
    }

    /**
     * Display the message about transaction done.
     *
     * @return \Illuminate\View\View
     */
    public function transactionMessage($order_number)
    {
        // Find payment by order number API
        $payment1 = $this::$api_client_manager::call('GET', getApiURL() . '/payment/find_by_order_number/' . $order_number);

        return view('transaction_message', [
            'message_content' => __('notifications.transaction_done'),
            'status_code' => (string) $payment1->data->status,
            'payment' => $payment1->data,
        ]);
    }

    /**
     * GET: Current user account
     *
     * @param $amount
     * @param $currency
     * @param $code
     * @param $cart_id
     * @return \Illuminate\View\View
     */
    public function paid($amount = null, $currency = null, $code, $entity, $entity_id)
    {
        if ($entity == 'paid_fund') {
            $paid_fund = PaidFund::find($entity_id);

            if ($code == '0') {
                return view('transaction_message', [
                    'amount' => $amount,
                    'currency' => $currency,
                    'status_code' => $code,
                    'paid_fund' => $paid_fund,
                    'message_content' => __('notifications.processing_succeed')
                ]);
            }

            if ($code == '1') {
                // Find payment by order number API
                $payment = $this::$api_client_manager::call('GET', getApiURL() . '/payment/find_by_order_number/' . Session::get('order_number'));

                if ($payment->success) {
                    // Update payment status API
                    $this::$api_client_manager::call('PUT', getApiURL() . '/payment/switch_status/' . $payment->data->id . '/2');
                }

                return view('transaction_message', [
                    'amount' => $amount,
                    'currency' => $currency,
                    'status_code' => $code,
                    'paid_fund' => $paid_fund,
                    'status_code' => $code,
                    'message_content' => __('notifications.process_canceled')
                ]);
            }

            if ($code == '2') {
                // Find payment by order number API
                $payment = $this::$api_client_manager::call('GET', getApiURL() . '/payment/find_by_order_number/' . Session::get('order_number'));

                if ($payment->success) {
                    // Update payment status API
                    $this::$api_client_manager::call('PUT', getApiURL() . '/payment/switch_status/' . $payment->data->id . '/2');
                }

                return view('transaction_message', [
                    'amount' => $amount,
                    'currency' => $currency,
                    'status_code' => $code,
                    'paid_fund' => $paid_fund,
                    'status_code' => $code,
                    'message_content' => __('notifications.process_failed')
                ]);
            }
        }

        if ($entity == 'cart') {
            $cart = Cart::find($entity_id);

            if ($code == '0') {
                return view('transaction_message', [
                    'amount' => $amount,
                    'currency' => $currency,
                    'status_code' => $code,
                    'cart' => $cart,
                    'message_content' => __('notifications.processing_succeed')
                ]);
            }

            if ($code == '1') {
                // Find payment by order number API
                $payment = $this::$api_client_manager::call('GET', getApiURL() . '/payment/find_by_order_number/' . Session::get('order_number'));

                if ($payment->success) {
                    // Update payment status API
                    $this::$api_client_manager::call('PUT', getApiURL() . '/payment/switch_status/' . $payment->data->id . '/2');
                }

                return view('transaction_message', [
                    'amount' => $amount,
                    'currency' => $currency,
                    'status_code' => $code,
                    'cart' => $cart,
                    'status_code' => $code,
                    'message_content' => __('notifications.process_canceled')
                ]);
            }

            if ($code == '2') {
                // Find payment by order number API
                $payment = $this::$api_client_manager::call('GET', getApiURL() . '/payment/find_by_order_number/' . Session::get('order_number'));

                if ($payment->success) {
                    // Update payment status API
                    $this::$api_client_manager::call('PUT', getApiURL() . '/payment/switch_status/' . $payment->data->id . '/2');
                }

                return view('transaction_message', [
                    'amount' => $amount,
                    'currency' => $currency,
                    'status_code' => $code,
                    'cart' => $cart,
                    'status_code' => $code,
                    'message_content' => __('notifications.process_failed')
                ]);
            }
        }
    }

    // ==================================== HTTP POST METHODS ====================================
    /**
     * POST: Run cart payment
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function runPay(Request $request)
    {
        $paid_fund = null;

        if ($request->transaction_type_id == null) {
            return redirect()->back()->with('error_message', __('notifications.transaction_type_error'));
        }

        if ($request->transaction_type_id == 1) {
            if (trim($request->other_phone_code) == null OR trim($request->other_phone_number) == null) {
                return redirect()->back()->with('error_message', __('validation.custom.phone.incorrect'));
            }
        }

        if (!empty($request->crowdfunding_id)) {
            $paid_fund = PaidFund::create([
                'crowdfunding_id' => $request->crowdfunding_id,
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'currency' => $request->currency
            ]);
        }

        if ($request->transaction_type_id != null) {
            $product_api = $this::$api_client_manager::call('POST', 
                                                            getApiURL() . '/product/purchase/' . $request->cart_id . '/' . $request->user_id, 
                                                            null, [
                                                                'transaction_type_id' => $request->transaction_type_id,
                                                                'other_phone' => $request->other_phone_code . $request->other_phone_number,
                                                                'user_id' => $request->user_id,
                                                                'cart_id' => $request->cart_id,
                                                                'app_url' => $request->app_url
                                                            ]);
            $paid_fund_api = $this::$api_client_manager::call('POST', 
                                                                getApiURL() . '/paid_fund/pay/' . $paid_fund->id . '/' . $request->user_id, 
                                                                null, [
                                                                'transaction_type_id' => $request->transaction_type_id,
                                                                'other_phone' => $request->other_phone_code . $request->other_phone_number,
                                                                'user_id' => $request->user_id,
                                                                'paid_fund_id' => $paid_fund->id,
                                                                'app_url' => $request->app_url
                                                            ]);

            if ($request->transaction_type_id == 1) {
                if ($request->other_phone_code == null or $request->other_phone_number == null) {
                    return redirect()->back()->with('error_message', __('validation.custom.phone.incorrect'));
                }

                $cart = !empty($request->crowdfunding_id) ? $paid_fund_api : $product_api;

                if ($cart->success) {
                    return redirect()->route('transaction.waiting', [
                        'app_id' => '-',
                        'success_message' => $cart->data->result_response->order_number . '-' . $request->user_id,
                    ]);

                } else {
                    return redirect()->back()->with('error_message', $cart->message);
                }
            }

            if ($request->transaction_type_id == 2) {
                $cart = !empty($request->crowdfunding_id) ? $paid_fund_api : $product_api;

                if ($cart->success) {
                    return redirect($cart->data->result_response->url)->with('order_number', $cart->data->result_response->order_number);

                } else {
                    return redirect()->back()->with('error_message', $cart->message);
                }
            }
        }
    }

    /**
     * POST: Update account
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function updateAccount(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // Preparing dynamic rules
        $rules = [];

        if ($request->has('firstname')) {
            $rules['firstname'] = ['required', 'string', 'max:255'];
        }

        if ($request->has('lastname')) {
            $rules['lastname'] = ['nullable', 'string', 'max:255'];
        }

        if ($request->has('surname')) {
            $rules['surname'] = ['nullable', 'string', 'max:255'];
        }

        if ($request->has('about_me')) {
            $rules['about_me'] = ['nullable', 'string', 'max:255'];
        }

        if ($request->has('gender')) {
            $rules['gender'] = ['nullable', Rule::in(['M', 'F'])];
        }

        if ($request->has('birthdate')) {
            $rules['birthdate'] = ['nullable', 'date_format:d/m/Y'];
        }

        if ($request->has('p_o_box')) {
            $rules['p_o_box'] = ['nullable', 'string', 'max:255'];
        }

        if ($request->has('address_1')) {
            $rules['address_1'] = ['nullable', 'string'];
        }

        if ($request->has('address_2')) {
            $rules['address_2'] = ['nullable', 'string'];
        }

        if ($request->has('phone')) {
            $rules['phone'] = ['nullable', 'string', 'max:20'];
        }

        if ($request->has('email') && $request->input('email') !== $user->email) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)];
        }

        if ($request->has('username') && $request->input('username') !== $user->username) {
            $rules['username'] = ['required', 'string', 'max:45', Rule::unique('users')->ignore($user->id)];
        }

        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }

        if ($request->has('image_64')) {
            $rules['image_64'] = ['required', 'string', 'starts_with:data:image/'];
        }

        // Validation of present fields only
        $validated = $request->validate($rules);

        // Date formatting
        if (isset($validated['birthdate'])) {
            $validated['birthdate'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['birthdate'])->format('Y-m-d');
        }

        // Password hash if present
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Processing of the base64 image if present
        if (isset($validated['image_64'])) {
            $replace = substr($validated['image_64'], 0, strpos($validated['image_64'], ',') + 1);
            $image = str_replace($replace, '', $validated['image_64']);
            $image = str_replace(' ', '+', $image);

            $image_path = 'images/users/' . $user->id . '/avatar/' . Str::random(50) . '.png';

            Storage::disk('public')->put($image_path, base64_decode($image));

            $validated['avatar_url'] = Storage::url($image_path);

            unset($validated['image_64']);
        }

        // Update user with valid fields
        $user->update($validated);

        // Update PasswordReset only if necessary
        $password_reset = !empty($user->email)
            ? \App\Models\PasswordReset::where('email', $user->email)->first()
            : \App\Models\PasswordReset::where('phone', $user->phone)->first();

        if ($password_reset) {
            $updateData = [];

            if ($request->filled('email')) {
                $updateData['email'] = $request->email;
            }

            if ($request->filled('phone')) {
                $updateData['phone'] = $request->phone;
            }

            $updateData['token'] = (string) random_int(1000000, 9999999);

            $password_reset->update($updateData);
        }

        // Conditional return: AJAX or HTML POST
        return $request->expectsJson()
            ? response()->json(['success_message' => true, 'avatar_url' => $user->avatar_url ?? null])
            : back()->with('success_message', 'Vos informations ont bien été mises à jour.');
    }

    /**
     * POST: Add a product entity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $entity
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function addProductEntity(Request $request, $entity)
    {
        if ($entity == 'category') {
            // $request->validate([
            //     'category_name.en' => 'required|string|max:255',
            //     'category_name.fr' => 'required|string|max:255',
            //     'category_description.en' => 'nullable|string',
            //     'category_description.fr' => 'nullable|string',
            //     'alias' => 'required|string|unique:categories,alias',
            //     'for_service' => 'nullable|boolean',
            // ]);

            $category = Category::create([
                'category_name' => [
                    'en' => $request->category_name_en,
                    'fr' => $request->category_name_fr
                ],
                'category_description' => [
                    'en' => $request->category_description_en,
                    'fr' => $request->category_description_fr
                ],
                'for_service' => $request->filled('for_service') ? $request->for_service : 0,
                'alias' => $request->alias,
                'created_by' => Auth::check() ? Auth::id() : null,
            ]);

            if (isset($request->image_64)) {
                // $extension = explode('/', explode(':', substr($request->image_64, 0, strpos($request->image_64, ';')))[1])[1];
                $replace = substr($request->image_64, 0, strpos($request->image_64, ',') + 1);
                // Find substring from replace here eg: data:image/png;base64,
                $image = str_replace($replace, '', $request->image_64);
                $image = str_replace(' ', '+', $image);
                // Create image URL
                $image_path = 'images/categories/' . $category->id . '/' . Str::random(50) . '.png';

                // Upload image
                Storage::disk('public')->put($image_path, base64_decode($image));

                $category->update([
                    'image_url' => Storage::url($image_path),
                    'updated_at' => now()
                ]);
            }

            return response()->json(['status' => 'success', 'message' => __('notifications.registered_data')]);
        }

        if ($entity == 'project' OR $entity == 'product' OR $entity == 'service') {
            // $request->validate([
            //     'product_name' => ['required', 'string', 'max:255'],
            //     'price' => ['required', 'float'],
            //     'quantity' => ['required', 'integer', 'min:1'],
            // ], [
            //     'product_name.required' => __('validation.required'),
            //     'price' => __('validation.required'),
            //     'quantity' => __('validation.required'),
            // ]);

            $product = Product::create([
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'currency' => $request->currency,
                'type' => $request->filled('type') ? $request->type : 'product',
                'action' => $request->filled('action') ? $request->action : 'sell',
                'is_shared' => $request->filled('is_shared') ? $request->is_shared : 0,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
                'created_by' => Auth::check() ? Auth::id() : null,
            ]);

            // If image files exist
            if ($request->hasFile('files_urls')) {
                $files = $request->file('files_urls', []);
                $fileNames = $request->input('files_names', []);

                // Types of extensions for different file types
                $video_extensions = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
                $photo_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $document_extensions = ['pdf', 'doc', 'docx', 'txt'];
                $audio_extensions = ['mp3', 'wav', 'flac'];

                foreach ($files as $key => $singleFile) {
                    // Checking the file extension
                    $file_extension = $singleFile->getClientOriginalExtension();

                    // File type check
                    $custom_uri = '';
                    $is_valid_type = false;
                    $file_type = null;

                    if (in_array($file_extension, $video_extensions)) { // File is a video
                        $custom_uri = 'videos/products';
                        $file_type = 'video';
                        $is_valid_type = true;

                    } elseif (in_array($file_extension, $photo_extensions)) { // File is a photo
                        $custom_uri = 'photos/products';
                        $file_type = 'photo';
                        $is_valid_type = true;

                    } elseif (in_array($file_extension, $audio_extensions)) { // File is an audio
                        $custom_uri = 'audios/products';
                        $file_type = 'audio';
                        $is_valid_type = true;

                    } elseif (in_array($file_extension, $document_extensions)) { // File is a document
                        $custom_uri = 'documents/products';
                        $file_type = 'video';
                        $is_valid_type = true;
                    }

                    // If the extension does not match any valid type
                    if (!$is_valid_type) {
                        return $this->handleError(__('notifications.type_is_not_file'));
                    }

                    // Generate a unique path for the file
                    $filename = $singleFile->getClientOriginalName();
                    $file_url =  $custom_uri . '/' . $product->id . '/' . $filename;

                    // Upload file
                    try {
                        $singleFile->storeAs($custom_uri . '/' . $product->id, $filename, 'public');

                    } catch (\Throwable $th) {
                        return $this->handleError($th, __('notifications.create_work_file_500'), 500);
                    }

                    // Creating the database record for the file
                    File::create([
                        'file_name' => trim($fileNames[$key] ?? $filename),
                        'file_url' => getWebURL() . '/storage/' . $file_url,
                        'file_type' => $file_type,
                        'product_id' => $product->id
                    ]);
                }
            }

            return response()->json(['status' => 'success', 'message' => __('notifications.registered_data')]);
        }
    }

    /**
     * POST: Add a post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addDiscussion(Request $request)
    {
        $post = Post::create([
            'posts_title' => $request->posts_title,
            'posts_content' => $request->posts_content,
            'event_start_at' => $request->event_start_at,
            'event_end_at' => $request->event_end_at,
            'answered_for' => $request->answered_for,
            'type' => $request->type,
            'for_category_id' => $request->for_category_id,
            'user_id' => Auth::id(),
        ]);

        // If image files exist
        if ($request->hasFile('files_urls')) {
            $files = $request->file('files_urls', []);
            $fileNames = $request->input('files_names', []);

            // Types of extensions for different file types
            $video_extensions = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
            $photo_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $document_extensions = ['pdf', 'doc', 'docx', 'txt'];
            $audio_extensions = ['mp3', 'wav', 'flac'];

            foreach ($files as $key => $singleFile) {
                // Checking the file extension
                $file_extension = $singleFile->getClientOriginalExtension();

                // File type check
                $custom_uri = '';
                $is_valid_type = false;
                $file_type = null;

                if (in_array($file_extension, $video_extensions)) { // File is a video
                    $custom_uri = 'videos/posts';
                    $file_type = 'video';
                    $is_valid_type = true;

                } elseif (in_array($file_extension, $photo_extensions)) { // File is a photo
                    $custom_uri = 'photos/posts';
                    $file_type = 'photo';
                    $is_valid_type = true;

                } elseif (in_array($file_extension, $audio_extensions)) { // File is an audio
                    $custom_uri = 'audios/posts';
                    $file_type = 'audio';
                    $is_valid_type = true;

                } elseif (in_array($file_extension, $document_extensions)) { // File is a document
                    $custom_uri = 'documents/posts';
                    $file_type = 'video';
                    $is_valid_type = true;
                }

                // If the extension does not match any valid type
                if (!$is_valid_type) {
                    return $this->handleError(__('notifications.type_is_not_file'));
                }

                // Generate a unique path for the file
                $filename = $singleFile->getClientOriginalName();
                $file_url =  $custom_uri . '/' . $post->id . '/' . $filename;

                // Upload file
                try {
                    $singleFile->storeAs($custom_uri . '/' . $post->id, $filename, 'public');

                } catch (\Throwable $th) {
                    return $this->handleError($th, __('notifications.create_work_file_500'), 500);
                }

                // Creating the database record for the file
                File::create([
                    'file_name' => trim($fileNames[$key] ?? $filename),
                    'file_url' => getWebURL() . '/storage/' . $file_url,
                    'file_type' => $file_type,
                    'post_id' => $post->id
                ]);
            }

            return response()->json(['status' => 'success', 'message' => __('notifications.registered_data')]);
        }
    }

    /**
     * POST: Update a product entity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $entity
     * @param  int  $id
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function updateProductEntity(Request $request, $entity, $id)
    {
        if ($entity == 'add-to-cart') {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::find($id);  // We get product to check the stock

            try {
                if (Auth::check()) {
                    // If user is connected, we add to its normal cart
                    $user = User::find(Auth::id());

                    $user->addProductToCart($id, $request->quantity);

                    $inCart = $user->hasProductInUnpaidCart($id);  // Check if product is in the cart
                    $inStock = $product->quantity > 0;  // Check if prouct is in stock
                    $isLoggedIn = true;

                } else {
                    // If user is connected, we store product in the session
                    $cart = session()->get('cart', []);
                    // Product photos
                    $photos = $product->photos()->pluck('file_url');
                    // Add product in the session cart
                    $cart[$id] = [
                        'id' => $product->id,
                        'product_name' => $product->product_name,
                        'product_description' => $product->product_description,
                        'quantity' => $request->quantity,
                        'price' => $product->price,
                        'currency' => $product->currency,
                        'type' => $product->type,
                        'action' => $product->action,
                        'photos' => $photos,
                    ];

                    session()->put('cart', $cart);

                    $inCart = true;  // Le produit est dans la session "panier"
                    $inStock = $product->quantity > 0;
                    $isLoggedIn = false;  // L'utilisateur n'est pas connecté
                }

                return response()->json([
                    'message' => __('notifications.added_data'),
                    'inCart' => $inCart,
                    'inStock' => $inStock,
                    'isLoggedIn' => $isLoggedIn,
                ]);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 422);
            }
        }
    }
}
