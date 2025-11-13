<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\ApiClientManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\Crowdfunding as ResourcesCrowdfunding;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\Project as ResourcesProject;
use App\Http\Resources\User as ResourcesUser;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Crowdfunding;
use App\Models\CustomerFeedback;
use App\Models\CustomerOrder;
use App\Models\File;
use App\Models\MarketSegment;
use App\Models\Notification;
use App\Models\PaidFund;
use App\Models\PasswordReset;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectActivity;
use App\Models\ProjectAnswer;
use App\Models\ProjectQuestion;
use App\Models\QuestionAssertion;
use App\Models\QuestionPart;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\GoogleDriveService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Nette\Utils\Random;

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
     * GET: Get notification badge
     *
     * @param  int  $user_id
     * @param  string  $language
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getNotificationBadge()
    {
        $unread_notifications = Notification::where('to_user_id', Auth::user()->id)->where('is_read', 0)->orderByDesc('created_at')->get();

        // Retourner la partie HTML du badge avec les notifications non lues
        return view('partials.notifications-badge', compact('unread_notifications'));
    }

    /**
     * GET: Generate Google Sheet document
     *
     * @param  GoogleDriveService  $driveService
     * @param  string  $language
     * @param  int  $user_id
     * @param  int  $project_id
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function generateSheet(GoogleDriveService $driveService, $language, $user_id, $project_id)
    public function generateSheet($language, $user_id, $project_id)
    {
        $user = User::find($user_id);

        if (is_null($user)) {
            return redirect()->back()->with('error_message', __('notifications.find_user_404'));
        }

        $project = Project::find($project_id);

        if (is_null($project)) {
            return redirect()->back()->with('error_message', __('notifications.find_project_404'));
        }

        // $localPath = public_path('assets/docs/financial-projection-' . $language . '.xlsx'); // <-- ton fichier source
        // $filename = 'Project_' . $project->id . '_' . now()->format('Ymd_His') . '.xlsx';
        // $mimeType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        // $folderId = '1eOgdv2m_9CadTp2yySuPdSxMoADRWRQz';
        // // Envoyer le fichier
        // $sheet_url = $driveService->uploadLocalFile($localPath, $filename, $mimeType, $folderId);

        // if ($sheet_url) {
        //     File::create([
        //         'file_name' => __('miscellaneous.admin.project_writing.user_project', ['user' => $user->firstname]),
        //         'file_url' => $sheet_url,
        //         'file_type' => 'sheet',
        //         'project_id' => $project->id
        //     ]);

        //     return redirect()->back()->with('success_message', __('notifications.create_file_success'));
        // }

        // return redirect()->back()->with('error_message', __('notifications.file_generation_error'));

        // 1. Définir le chemin source basé sur la langue
        $sourcePath = public_path("assets/docs/financial-projection-{$language}.xlsx");

        // 2. Définir le nom de fichier de destination
        $fileName = "user-project-{$user->id}-{$project->id}.xlsx";

        // 3. Définir le chemin de destination (dans le disque "public")
        $destinationPath = "sheets/{$fileName}";

        // 4. Lire le contenu du fichier source
        if (!file_exists($sourcePath)) {
            return redirect()->back()->with('error_message', __('notifications.find_file_404') . ' - TEMPLATE');
        }

        // 5. Copier dans le dossier de destination
        Storage::disk('public')->put($destinationPath, file_get_contents($sourcePath));

        // 6. Générer l'URL publique du fichier
        $sheet_url = Storage::url($destinationPath); // e.g. /storage/sheets/user-project-1-1.xlsx

        // 7. Enregistrer dans la base de données
        File::create([
            'file_name' => __('miscellaneous.admin.project_writing.user_project', ['user' => $user->firstname]),
            'file_url' => $sheet_url,
            'file_type' => 'sheet',
            'project_id' => $project->id
        ]);

        return redirect()->back()->with('success_message', __('notifications.create_file_success'));
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
     * GET: Terms of use page
     * 
     * @return \Illuminate\View\View
     */
    public function termsOfUse()
    {
        $titles = Lang::get('miscellaneous.public.about.terms_of_use.titles');

        return view('terms', ['titles' => $titles]);
    }

    /**
     * GET: Privacy policy page
     * 
     * @return \Illuminate\View\View
     */
    public function privacyPolicy()
    {
        $titles = Lang::get('miscellaneous.public.about.privacy_policy.titles');

        return view('privacy', ['titles' => $titles]);
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
    public function accountEntity(Request $request, NotificationService $service, $entity)
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

        if ($entity == 'notifications') {
            $items = $service->getUserNotifications($current_user->id);
        }

        if ($entity == 'customers') {
            $entity_title = __('miscellaneous.menu.account.customer');
            // Get the period of ordering
            $period = $request->get('period') ?? 'yearly'; // Default is "daily"
            // Get user customers
            $items = $current_user->customersInPeriod($period);
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
            $query = Product::where([['type', 'product'], ['is_shared', 1], ['category_id', $categoryId]]);

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
            $query = Product::where([['type', 'service'], ['is_shared', 1], ['category_id', $categoryId]]);

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
        $selected_product = Product::find($id);

        if (is_null($selected_product)) {
            return redirect('/')->with('error_message', __('notifications.find_product_404'));
        }

        $entity_title = $entity == 'product' ? __('miscellaneous.menu.public.products.about_product') : __('miscellaneous.menu.public.products.about_service');
        $categories = $entity == 'product' ? Category::withCount('products')->where('for_service', 0)->get() : Category::withCount('products')->where('for_service', 1)->get();

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
        $category = $entity == 'product' ? Category::where([['id', $categoryId], ['for_service', 0]])->first() : Category::where([['id', $categoryId], ['for_service', 1]])->first();

        return view('products', [
            'entity_title' => $entity_title,
            'entity' => $entity,
            'category' => $category,
            'categories' => $categories,
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
        $projects = Project::orderByDesc('created_at')->paginate(12)->appends(request()->query());
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
            'projects' => $projects,
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
        // 🔹 1. Charger le projet
        $project = Project::with([
            'project_answers' => function ($q) {
                $q->whereNotNull('answer_content'); // seulement les réponses remplies
            },
            'project_answers.project_question.question_part' // on charge la question et sa partie associée
        ])->findOrFail($id);

        // 🔹 2. Organiser les réponses par "partie" (QuestionPart)
        $groupedByPart = $project->project_answers
            ->filter(fn($a) => !empty(trim($a->answer_content))) // ignorer les réponses vides
            ->groupBy(fn($a) => optional($a->project_question->question_part)->part_name ?? 'Autres');

        // Vérifier s'il existe une feuille complète pour ce projet
        $completedSheet = $project->sheets->where('is_sheet_completed', 1)->first();

        return view('investors', [
            'entity_title' => $entity_title,
            'groupedByPart' => $groupedByPart,
            'selected_project' => $project,
            'completedSheet' => $completedSheet,
            'countries' => showCountries()
        ]);
    }

    /**
     * GET: Crowdfundings (Project writing) page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\View\View
     */
    public function crowdfunding(Request $request, Project $project = null)
    {
        // Étape actuelle
        $stepRef = $request->get('step_ref');

        // Si aucune étape spécifiée → on prend la première
        $currentPart = $stepRef
            ? QuestionPart::findOrFail($stepRef)
            : QuestionPart::where('is_first_step', 1)->firstOrFail();

        // Charger les questions de cette étape
        $questions = ProjectQuestion::with('question_assertions')
            ->where('question_part_id', $currentPart->id)
            ->get();

        return view('crowdfundings', [
            'project' => $project,
            'questions' => $questions,
            'currentPart' => $currentPart,
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
        // 🔹 1. Charger le projet
        $project = Project::with([
            'project_answers' => function ($q) {
                $q->whereNotNull('answer_content'); // seulement les réponses remplies
            },
            'project_answers.project_question.question_part' // on charge la question et sa partie associée
        ])->findOrFail($id);
    
        // 🔹 2. Organiser les réponses par "partie" (QuestionPart)
        $groupedByPart = $project->project_answers
            ->filter(fn($a) => !empty(trim($a->answer_content))) // ignorer les réponses vides
            ->groupBy(fn($a) => optional($a->project_question->question_part)->part_name ?? 'Autres');

        // Vérifier s'il existe une feuille complète pour ce projet
        $completedSheet = $project->sheets->where('is_sheet_completed', 1)->first();

        return view('crowdfundings', [
            'entity_title' => $entity_title,
            'groupedByPart' => $groupedByPart,
            'selected_project' => $project,
            'completedSheet' => $completedSheet,
        ]);
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
        if ($entity == 'project') {
            $project = Project::find($entity_id);

            if ($code == '0') {
                return view('transaction_message', [
                    'amount' => $amount,
                    'currency' => $currency,
                    'status_code' => $code,
                    'project' => $project,
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
                    'project' => $project,
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
                    'project' => $project,
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

    // ==================================== HTTP DELETE METHODS ====================================
    /**
     * GET: Delete something
     *
     * @param  string $entity
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function removeData($entity, $id)
    {
        if ($entity == 'role') {
            $role = Role::find($id);

            if (!$role) {
                return response()->json([
                    'success' => false,
                    'message' => __('notifications.find_role_404'),
                ], 404);
            }

            $role->delete();

            return response()->json([
                'success' => true,
                'message' => __('notifications.delete_role_success'),
            ]);
        }

        if ($entity == 'product') {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => __('notifications.find_product_404'),
                ], 404);
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

            return response()->json([
                'success' => true,
                'message' => __('notifications.delete_product_success'),
            ]);
        }

        if ($entity == 'order') {
            try {
                // We start by retrieving the order associated with this ID (for connected users)
                if (Auth::check()) {
                    // If the user is logged in
                    $user = User::find(Auth::id());

                    // Get user's unpaid cart
                    $cart = $user->unpaidCart()->first();

                    if (!$cart) {
                        return response()->json([
                            'success' => false,
                            'message' => __('notifications.find_cart_404')
                        ], 404);
                    }

                    // Find the order to delete from the order ID in the cart
                    $existingOrder = $cart->customer_orders()->find($id);

                    if (!$existingOrder) {
                        return response()->json([
                            'success' => false,
                            'message' => __('notifications.find_customer_order_404')
                        ], 404);
                    }

                    // Delete order (cart line)
                    $existingOrder->delete();

                    // Retrieve the associated product to restore stock
                    $product = $existingOrder->product;

                    // Restore product stock
                    $product->increment('quantity', $existingOrder->quantity);

                    // Check if the product is still in the user's cart
                    $inCart = !$cart->customer_orders()->find($id);

                    // If the cart is empty, it is deleted from the database
                    if ($cart->customer_orders->isEmpty()) {
                        $cart->delete();
                    }

                    $isLoggedIn = true;

                } else {
                    // If the user is not logged in, we work with the cart in the session
                    $cart = session()->get('cart', []);

                    // Check if order exists in session (by order ID)
                    if (isset($cart[$id])) {
                        // Remove product from session
                        unset($cart[$id]);
                        session()->put('cart', $cart);

                        // Check if the cart is empty
                        if (empty($cart)) {
                            // If the cart is empty, delete the session
                            session()->forget('cart');
                        }

                        $inCart = false;  // The product has been removed from the cart

                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => __('notifications.find_product_404')
                        ], 404);
                    }

                    $isLoggedIn = false;
                }

                return response()->json([
                    'success' => true,
                    'message' => __('notifications.delete_customer_order_success'),
                    'inCart' => $inCart,
                    'isLoggedIn' => $isLoggedIn,
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }
        }

        if ($entity == 'cart') {
            $cart = Cart::find($id);

            if (!$cart) {
                return response()->json([
                    'success' => false,
                    'message' => __('notifications.find_cart_404'),
                ], 404);
            }

            $cart->delete();

            return response()->json([
                'success' => true,
                'message' => __('notifications.delete_cart_success'),
            ]);
        }

        if ($entity == 'project') {
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => __('notifications.find_project_404'),
                ], 404);
            }

            $project_answers = ProjectAnswer::where('project_id', $project->id)->get();
            $files = File::where('project_id', $project->id)->get();

            if (!$project_answers->isEmpty()) {
                foreach ($project_answers as $answer) {
                    $answer->delete();
                }
            }

            if (!$files->isEmpty()) {
                foreach ($files as $file) {
                    $file->delete();
                }
            }

            $project->delete();

            return response()->json([
                'success' => true,
                'message' => __('notifications.delete_project_success'),
            ]);
        }

        if ($entity == 'part') {
            $question_part = QuestionPart::find($id);

            if (!$question_part) {
                return response()->json([
                    'success' => false,
                    'message' => __('notifications.find_question_part_404'),
                ], 404);
            }

            $project_questions = ProjectQuestion::where('question_part_id', $question_part->id)->get();

            if (!$project_questions->isEmpty()) {
                foreach ($project_questions as $project_question) {
                    $question_assertions = QuestionAssertion::where('project_question_id', $project_question->id)->get();

                    if (!$question_assertions->isEmpty()) {
                        foreach ($question_assertions as $question_assertion) {
                            $question_assertion->delete();
                        }
                    }

                    $project_question->delete();
                }
            }

            $question_part->delete();

            return response()->json([
                'success' => true,
                'message' => __('notifications.delete_question_part_success'),
            ]);
        }

        if ($entity == 'question') {
            $project_question = ProjectQuestion::find($id);

            if (!$project_question) {
                return response()->json([
                    'success' => false,
                    'message' => __('notifications.find_project_question_404'),
                ], 404);
            }

            $question_assertions = QuestionAssertion::where('project_question_id', $project_question->id)->get();

            if (!$question_assertions->isEmpty()) {
                foreach ($question_assertions as $question_assertion) {
                    $question_assertion->delete();
                }
            }

            $project_question->delete();

            return response()->json([
                'success' => true,
                'message' => __('notifications.delete_project_question_success'),
            ]);
        }

        if ($entity == 'assertion') {
            $question_assertion = QuestionAssertion::find($id);

            if (!$question_assertion) {
                return response()->json([
                    'success' => false,
                    'message' => __('notifications.find_question_assertion_404'),
                ], 404);
            }

            $question_assertion->delete();

            return response()->json([
                'success' => true,
                'message' => __('notifications.delete_question_assertion_success'),
            ]);
        }

        if ($entity == 'answer') {
            $project_answer = ProjectAnswer::find($id);

            if (!$project_answer) {
                return response()->json([
                    'success' => false,
                    'message' => __('notifications.find_project_answer_404'),
                ], 404);
            }

            $project_answer->delete();

            return response()->json([
                'success' => true,
                'message' => __('notifications.delete_project_answer_success'),
            ]);
        }
    }
    // ==================================== HTTP POST METHODS ====================================
    /**
     * POST: Run cart payment
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function sendFile(Request $request)
    {
        // Vérifier si un fichier est bien envoyé
        if ($request->hasFile('sheet_url')) {
            $file = $request->file('sheet_url');
            $originalFileName = $file->getClientOriginalName();
            $file_url =  'sheets/' . $originalFileName;

            // Upload file
            try {
                $file->storeAs('sheets', $originalFileName, 'public');

            } catch (\Throwable $th) {
                return redirect()->back()->with('error_message', __('notifications.create_work_file_500'));
            }

            // Creating the database record for the file
            File::create([
                'file_name' => $request->file_name,
                'file_url' => '/storage/' . $file_url,
                'file_type' => 'sheet',
                'is_sheet_completed' => 1,
                'project_id' => $request->project_id
            ]);

            // Retourner un message de succès
            return redirect()->back()->with('success_message', 'Fichier envoyé et enregistré avec succès.');
        }

        // En cas d'erreur (pas de fichier)
        return redirect()->back()->with('error_message', 'Veuillez télécharger un fichier Excel valide.');
    }

    /**
     * POST: Run cart payment
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function runPay(Request $request)
    {
        if ($request->transaction_type_id == null) {
            return redirect()->back()->with('error_message', __('notifications.transaction_type_error'));
        }

        if ($request->transaction_type_id == 1) {
            if (trim($request->other_phone_code) == null OR trim($request->other_phone_number) == null) {
                return redirect()->back()->with('error_message', __('validation.custom.phone.incorrect'));
            }
        }

        if (!empty($request->paid_fund)) {
            $user = User::find($request->user_id);

            if (is_null($user)) {
                return redirect('/')->with('error_message', __('notifications.find_user_404'));
            }

            $project = Project::find($request->project_id);

            if (is_null($project)) {
                return redirect('/')->with('error_message', __('notifications.find_project_404'));
            }

            // 1️⃣ Trouver le rôle "Investisseur"
            $role = Role::where('role_name->fr', 'Investisseur')->first();

            if ($role) {
                // 2️⃣ Récupérer tous les rôles associés à l'utilisateur
                $userRoleIds = $user->roles->pluck('id');

                // 3️⃣ Mettre tous les rôles existants de l'utilisateur à is_selected = 0
                if ($userRoleIds->isNotEmpty()) {
                    $user->roles()->updateExistingPivot($userRoleIds, ['is_selected' => 0]);
                }

                // 4️⃣ Vérifier si le rôle "Investisseur" est déjà associé à l'utilisateur
                $hasRole = $user->roles()->where('roles.id', $role->id)->exists();

                if (! $hasRole) {
                    // 🔹 Si le rôle n'est pas encore lié, on l'attache avec is_selected = 1
                    $user->roles()->attach($role->id, ['is_selected' => 1]);

                } else {
                    // 🔹 Si le rôle existe déjà, on le met simplement à is_selected = 1
                    $user->roles()->updateExistingPivot($role->id, ['is_selected' => 1]);
                }
            }

            $user->projects()->attach($project->id, [
                'paid_fund' => $request->paid_fund,
                'currency' => !empty($request->currency) ? $request->currency : 'USD'
            ]);
        }

        if ($request->transaction_type_id != null) {
            $product_api = $this::$api_client_manager::call('POST', 
                                                            getApiURL() . '/product/purchase/' . $request->cart_id . '/' . $request->user_id, 
                                                            null, [
                                                                'transaction_type_id' => $request->transaction_type_id,
                                                                'other_phone' => $request->other_phone_code . $request->other_phone_number,
                                                                'amount' => $request->amount,
                                                                'user_id' => $request->user_id,
                                                                'cart_id' => $request->cart_id,
                                                                'app_url' => $request->app_url
                                                            ]);
            $paid_fund_api = $this::$api_client_manager::call('POST', 
                                                            getApiURL() . '/paid_fund/pay/' . $request->user_id, 
                                                            null, [
                                                                'transaction_type_id' => $request->transaction_type_id,
                                                                'project_id' => $request->project_id,
                                                                'other_phone' => $request->other_phone_code . $request->other_phone_number,
                                                                'paid_fund' => $request->paid_fund,
                                                                'currency' => $request->currency,
                                                                'app_url' => $request->app_url
                                                            ]);

            if ($request->transaction_type_id == 1) {
                if ($request->other_phone_code == null or $request->other_phone_number == null) {
                    return redirect()->back()->with('error_message', __('validation.custom.phone.incorrect'));
                }

                $cart = !empty($request->paid_fund) ? $paid_fund_api : $product_api;
                // $cart = $product_api;

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
                $cart = !empty($request->paid_fund) ? $paid_fund_api : $product_api;
                // $cart = $product_api;

                if ($cart->success) {
                    return redirect($cart->data->result_response->url)->with('order_number', $cart->data->result_response->order_number);

                } else {
                    return redirect()->back()->with('error_message', $cart->message);
                }
            }
        }
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
        $current_user = User::find(Auth::id());

        if ($entity == 'product' OR $entity == 'service') {
            $role_seller = null;
            $role_seller_exists = Role::where('role_name->fr', 'Vendeur')->exists();

            if (!$role_seller_exists) {
                $role_seller = Role::create([
                    'role_name' => [
                        'en' => 'Seller',
                        'fr' => 'Vendeur',
                    ],
                    'role_description' => [
                        'en' => 'A person who sells or distributes products, or offers services.',
                        'fr' => 'Personne qui vend ou distribue des produits, ou qui offre des services.',
                    ]
                ]);
            }

            if ($request->category_id == 3) {
                if (condition) {
                    # code...
                }
                return response()->json(['status' => 'error', 'message' => __('notifications.type_is_not_file')]);
            }

            $role_seller = Role::where('role_name->fr', 'Vendeur')->first();
            $product = Product::create([
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'currency' => $request->currency,
                'type' => $request->filled('type') ? $request->type : $entity,
                'action' => $request->filled('action') ? $request->action : 'sell',
                'is_shared' => $request->filled('is_shared') ? $request->is_shared : 0,
                'category_id' => $request->category_id,
                'user_id' => $current_user->id,
                'created_by' => $current_user->id,
            ]);

            // If image files exist
            if ($request->hasFile('files_urls')) {
                $files = $request->file('files_urls', []);
                $fileNames = $request->input('files_names', []);

                // Types of extensions for different file types
                $video_extensions = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
                $photo_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff', 'tif', 'svg', 'heif', 'heic', 'ico'];
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
                        return response()->json(['status' => 'error', 'message' => __('notifications.type_is_not_file')]);
                    }

                    // Generate a unique path for the file
                    $filename = $singleFile->getClientOriginalName();
                    $file_url =  $custom_uri . '/' . $product->id . '/' . $filename;

                    // Upload file
                    try {
                        $singleFile->storeAs($custom_uri . '/' . $product->id, $filename, 'public');

                    } catch (\Throwable $th) {
                        return response()->json(['status' => 'error', 'message' => __('notifications.create_work_file_500')]);
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

            // Update user role to "Seller" if he doesn't have that role
            if ($current_user->selected_role->id != $role_seller->id) {
                DB::beginTransaction();

                try {
                    // 1. Update all other roles for this user and set is_selected to 0
                    $current_user->roles()->updateExistingPivot($current_user->roles->pluck('id')->toArray(), ['is_selected' => 0]);
                    // 2. Add the new role and set is_selected to 1
                    $current_user->roles()->attach($role_seller->id, ['is_selected' => 1]);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
            }

            /*
                NOTIFICATION MANAGEMENT
            */
            $administrators = User::whereHas('roles', function ($query) {
                                        $query->where('role_name->fr', 'Administrateur');
                                    })->get();

            foreach ($administrators as $admin) {
                Notification::create([
                    'type' => 'product_published',
                    'is_read' => 0,
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $admin->id,
                    'product_id' => $product->id
                ]);
            }

            return response()->json(['status' => 'success', 'message' => __('notifications.registered_data')]);
        }

        if ($entity == 'feedback') {
            $current_product = Product::find($request->for_product_id);

            if (!$current_product) {
                return redirect()->back()->with('error_message', __('miscellaneous.message_sent'));
            }

            CustomerFeedback::create([
                'for_product_id' => $current_product->id,
                'comment' => $request->comment,
                'user_id' => Auth::id(),
            ]);


            Notification::create([
                'type' => 'customer_feedback',
                'is_read' => 0,
                'from_user_id' => Auth::id(),
                'to_user_id' => $current_product->user_id,
                'product_id' => $current_product->id
            ]);

            return redirect()->back()->with('success_message', __('miscellaneous.message_sent'));
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
            $photo_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff', 'tif', 'svg', 'heif', 'heic', 'ico'];
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
                    $file_type = 'document';
                    $is_valid_type = true;
                }

                // If the extension does not match any valid type
                if (!$is_valid_type) {
                    return response()->json(['status' => 'error', 'message' => __('notifications.type_is_not_file')]);
                }

                // Generate a unique path for the file
                $filename = $singleFile->getClientOriginalName();
                $file_url =  $custom_uri . '/' . $post->id . '/' . $filename;

                // Upload file
                try {
                    $singleFile->storeAs($custom_uri . '/' . $post->id, $filename, 'public');

                } catch (\Throwable $th) {
                    return response()->json(['status' => 'error', 'message' => __('notifications.create_work_file_500')]);
                }

                // Creating the database record for the file
                File::create([
                    'file_name' => trim($fileNames[$key] ?? $filename),
                    'file_url' => getWebURL() . '/storage/' . $file_url,
                    'file_type' => $file_type,
                    'post_id' => $post->id
                ]);
            }
        }

        if ($post->type == 'comment') {
            $parent_post = Post::find($post->answered_for);

            /*
                NOTIFICATION MANAGEMENT
            */
            if (!is_null($parent_post)) {
                Notification::create([
                    'type' => 'post_answered',
                    'is_read' => 0,
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $parent_post->user_id,
                    'post_id' => $parent_post->id
                ]);
            }
        }

        return response()->json(['status' => 'success', 'message' => __('notifications.registered_data')]);
        // return response()->json(['status' => 'error', 'message' => $request->posts_content]);
    }

    /**
     * POST: Add a project
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProject(Request $request)
    {
        $user_projects = Project::where('user_id', Auth::id())->get();

        // If current user has already 3 projects, don't register another
        if (count($user_projects) >= 3) {
            return redirect()->back()->with('error_message', __('miscellaneous.admin.project_writing.my_projects.info'));
        }

        // 1️⃣ Création ou récupération du projet
        $project = $request->has('project_id') ? Project::findOrFail($request->project_id) : Project::create(['is_shared' => 0, 'user_id' => auth()->id(), 'project_description' => $request->project_description]);

        // If image files exist
        if ($request->hasFile('files_urls')) {
            $files = $request->file('files_urls', []);
            $fileNames = $request->input('files_names', []);

            // Types of extensions for different file types
            $video_extensions = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
            $photo_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff', 'tif', 'svg', 'heif', 'heic', 'ico'];
            $document_extensions = ['pdf', 'doc', 'docx', 'txt'];
            $audio_extensions = ['mp3', 'wav', 'flac'];

            foreach ($files as $key => $singleFile) {
                // Checking the file extension
                $file_extension = strtolower($singleFile->getClientOriginalExtension());

                // File type check
                $custom_uri = '';
                $is_valid_type = false;
                $file_type = null;

                if (in_array($file_extension, $video_extensions)) { // File is a video
                    $custom_uri = 'videos/projects';
                    $file_type = 'video';
                    $is_valid_type = true;

                } elseif (in_array($file_extension, $photo_extensions)) { // File is a photo
                    $custom_uri = 'photos/projects';
                    $file_type = 'photo';
                    $is_valid_type = true;

                } elseif (in_array($file_extension, $audio_extensions)) { // File is an audio
                    $custom_uri = 'audios/projects';
                    $file_type = 'audio';
                    $is_valid_type = true;

                } elseif (in_array($file_extension, $document_extensions)) { // File is a document
                    $custom_uri = 'documents/projects';
                    $file_type = 'document';
                    $is_valid_type = true;
                }

                // If the extension does not match any valid type
                if (!$is_valid_type) {
                    return redirect('/project-writing/?project=' . $project->id . '&step_ref=2')->with('error_message', __('notifications.type_is_not_file'));
                }

                // Generate a unique path for the file
                $filename = $singleFile->getClientOriginalName();
                $file_url =  $custom_uri . '/' . $project->id . '/' . $filename;

                // Upload file
                try {
                    $singleFile->storeAs($custom_uri . '/' . $project->id, $filename, 'public');

                } catch (\Throwable $th) {
                    return redirect('/project-writing/?project=' . $project->id . '&step_ref=2')->with('error_message', __('notifications.create_work_file_500'));
                }

                // Creating the database record for the file
                File::create([
                    'file_name' => trim($fileNames[$key] ?? $filename),
                    'file_url' => getWebURL() . '/storage/' . $file_url,
                    'file_type' => $file_type,
                    'project_id' => $project->id
                ]);
            }
        }

        // 2️⃣ Enregistrement des réponses
        foreach ($request->input('answers', []) as $questionId => $answer) {
            // Cas 1 : c’est un champ composé (valeur + unité)
            if (is_array($answer) && array_key_exists('value', $answer) && array_key_exists('unit', $answer)) {
                $value = trim($answer['value'] ?? '');
                $unit = trim($answer['unit'] ?? '');
                $answerText = $value && $unit ? "{$value} {$unit}" : ($value ?: $unit);
            }

            // Cas 2 : c’est une liste (checkbox)
            elseif (is_array($answer)) {
                $answerText = implode(', ', $answer);
            }

            // Cas 3 : c’est un champ simple (texte, radio, etc.)
            else {
                $answerText = $answer;
            }

            // Sauvegarde / mise à jour
            ProjectAnswer::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'project_question_id' => $questionId,
                ],
                ['answer_content' => $answerText]
            );
        }

        // 3️⃣ Étape suivante ou fin
        $currentPart = QuestionPart::findOrFail($request->get('current_part_id'));

        if ($currentPart->is_last_step == 0) {
            $nextPart = QuestionPart::where('id', '>', $currentPart->id)->first();

            return redirect('/project-writing/?project=' . $project->id . '&step_ref=' . $nextPart->id)->with('success', __('notifications.update_project_success'));

        } else {
            // 4️⃣ Notifications (inchangées)
            $administrators = User::whereHas('roles', fn($q) => $q->where('role_name->fr', 'Administrateur'))->get();
    
            foreach ($administrators as $admin) {
                Notification::create([
                    'type' => 'project_published',
                    'is_read' => 0,
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $admin->id,
                    'project_id' => $project->id
                ]);
            }
    
            return redirect('/project-writing/' . $project->id)->with('success', __('notifications.create_project_success'));
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
        // Get inputs
        $inputs = [
            'id' => $request->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'nationality' => $request->nationality,
            'country' => $request->country,
            'province' => $request->province,
            'territory' => $request->territory,
            'city' => $request->city,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'p_o_box' => $request->p_o_box,
            'currency' => $request->currency,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'status' => $request->status,
        ];
        $users = User::all();
        $current_user = User::find($inputs['id']);

        if ($inputs['firstname'] != null) {
            $user->update([
                'firstname' => $inputs['firstname'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['lastname'] != null) {
            $user->update([
                'lastname' => $inputs['lastname'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['surname'] != null) {
            $user->update([
                'surname' => $inputs['surname'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['gender'] != null) {
            $user->update([
                'gender' => $inputs['gender'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['birthdate'] != null) {
            $user->update([
                'birthdate' => $inputs['birthdate'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['nationality'] != null) {
            $user->update([
                'nationality' => $inputs['nationality'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['country'] != null) {
            $user->update([
                'country' => $inputs['country'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['province'] != null) {
            $user->update([
                'province' => $inputs['province'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['territory'] != null) {
            $user->update([
                'territory' => $inputs['territory'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['city'] != null) {
            $user->update([
                'city' => $inputs['city'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['address_1'] != null) {
            $user->update([
                'address_1' => $inputs['address_1'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['address_2'] != null) {
            $user->update([
                'address_2' => $inputs['address_2'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['p_o_box'] != null) {
            $user->update([
                'p_o_box' => $inputs['p_o_box'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['currency'] != null) {
            $user->update([
                'currency' => $inputs['currency'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['email'] != null) {
            // Check if email already exists
            foreach ($users as $another_user):
                if (!empty($current_user->email)) {
                    if ($current_user->email != $inputs['email']) {
                        if ($another_user->email == $inputs['email']) {
                            return back()->with('error_message', __('validation.custom.email.exists'));
                        }
                    }
                }
            endforeach;

            if ($current_user->email != $inputs['email']) {
                $user->update([
                    'email' => $inputs['email'],
                    'email_verified_at' => null,
                    'updated_at' => now(),
                ]);

            } else {
                $user->update([
                    'email' => $inputs['email'],
                    'updated_at' => now(),
                ]);
            }

            if (!empty($current_user->phone)) {
                $password_reset_by_phone = PasswordReset::where('phone', $current_user->phone)->first();
                $random_int_stringified = (string) random_int(1000000, 9999999);

                if ($password_reset_by_phone != null) {
                    if (!empty($password_reset_by_phone->email)) {
                        if ($password_reset_by_phone->email != $inputs['email']) {
                            $password_reset_by_phone->update([
                                'email' => $inputs['email'],
                                'former_password' => $inputs['password'] != null ? $inputs['password'] : Random::generate(10, '0-9a-zA-Z'),
                                'updated_at' => now(),
                            ]);
                        }
                    }

                    if (empty($password_reset_by_phone->email)) {
                        $password_reset_by_phone->update([
                            'email' => $inputs['email'],
                            'former_password' => $inputs['password'] != null ? $inputs['password'] : Random::generate(10, '0-9a-zA-Z'),
                            'updated_at' => now(),
                        ]);
                    }
                }

                if ($password_reset_by_phone == null) {
                    $password_reset_by_email = PasswordReset::where('email', $inputs['email'])->first();

                    if ($password_reset_by_email == null) {
                        PasswordReset::create([
                            'email' => $inputs['email'],
                            'phone' => $current_user->phone,
                            'token' => $random_int_stringified,
                            'former_password' => $inputs['password'] != null ? $inputs['password'] : Random::generate(10, 'a-zA-Z'),
                        ]);
                    }
                }

            } else {
                $random_int_stringified = (string) random_int(1000000, 9999999);

                PasswordReset::create([
                    'email' => $inputs['email'],
                    'token' => $random_int_stringified,
                    'former_password' => $inputs['password'] != null ? $inputs['password'] : Random::generate(10, 'a-zA-Z'),
                ]);
            }
        }

        if ($inputs['phone'] != null) {
            // Check if phone already exists
            foreach ($users as $another_user):
                if (!empty($current_user->phone)) {
                    if ($current_user->phone != $inputs['phone']) {
                        if ($another_user->phone == $inputs['phone']) {
                            return back()->with('error_message', __('validation.custom.phone.exists'));
                        }
                    }
                }
            endforeach;

            if ($current_user->phone != $inputs['phone']) {
                $user->update([
                    'phone' => $inputs['phone'],
                    'phone_verified_at' => null,
                    'updated_at' => now(),
                ]);

            } else {
                $user->update([
                    'phone' => $inputs['phone'],
                    'updated_at' => now(),
                ]);
            }

            if (!empty($current_user->email)) {
                $password_reset_by_email = PasswordReset::where('email', $current_user->email)->first();
                $random_int_stringified = (string) random_int(1000000, 9999999);

                if ($password_reset_by_email != null) {
                    if (!empty($password_reset_by_email->phone)) {
                        if ($password_reset_by_email->phone != $inputs['phone']) {
                            $password_reset_by_email->update([
                                'phone' => $inputs['phone'],
                                'former_password' => $inputs['password'] != null ? $inputs['password'] : Random::generate(10, '0-9a-zA-Z'),
                                'updated_at' => now(),
                            ]);
                        }
                    }

                    if (empty($password_reset_by_email->phone)) {
                        $password_reset_by_email->update([
                            'phone' => $inputs['phone'],
                            'former_password' => $inputs['password'] != null ? $inputs['password'] : Random::generate(10, '0-9a-zA-Z'),
                            'updated_at' => now(),
                        ]);
                    }
                }

                if ($password_reset_by_email == null) {
                    $password_reset_by_phone = PasswordReset::where('phone', $inputs['phone'])->first();

                    if ($password_reset_by_email == null) {
                        PasswordReset::create([
                            'email' => $current_user->email,
                            'phone' => $inputs['phone'],
                            'token' => $random_int_stringified,
                            'former_password' => $inputs['password'] != null ? $inputs['password'] : Random::generate(10, 'a-zA-Z'),
                        ]);
                    }
                }

            } else {
                $random_int_stringified = (string) random_int(1000000, 9999999);

                PasswordReset::create([
                    'phone' => $inputs['phone'],
                    'token' => $random_int_stringified,
                    'former_password' => $inputs['password'] != null ? $inputs['password'] : Random::generate(10, 'a-zA-Z'),
                ]);
            }
        }

        if ($inputs['username'] != null) {
            // Check if username already exists
            foreach ($users as $another_user):
                if (!empty($current_user->username)) {
                    if ($current_user->username != $inputs['username']) {
                        if ($another_user->username == $inputs['username']) {
                            return back()->with('error_message', __('validation.custom.username.exists'));
                        }
                    }
                }
            endforeach;

            $user->update([
                'username' => $inputs['username'],
                'updated_at' => now(),
            ]);
        }

        if ($inputs['password'] != null) {
            if ($inputs['confirm_password'] != $inputs['password'] OR $inputs['confirm_password'] == null) {
                return back()->with('error_message', __('notifications.confirm_password_error'));
            }

            // if (preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#', $inputs['password']) == 0) {
            //     return response()->json(['status' => 'error', 'message' => __('miscellaneous.password.error')]);
            // }

            if (!empty($current_user->email)) {
                $password_reset = PasswordReset::where('email', $current_user->email)->first();
                $random_int_stringified = (string) random_int(1000000, 9999999);

                // If password_reset exists, update it
                if ($password_reset != null) {
                    $password_reset->update([
                        'token' => $random_int_stringified,
                        'former_password' => $inputs['password'],
                        'updated_at' => now(),
                    ]);
                }

            } else {
                if (!empty($current_user->phone)) {
                    $password_reset = PasswordReset::where('phone', $current_user->phone)->first();
                    $random_int_stringified = (string) random_int(1000000, 9999999);

                    // If password_reset exists, update it
                    if ($password_reset != null) {
                        $password_reset->update([
                            'token' => $random_int_stringified,
                            'former_password' => $inputs['password'],
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            $user->update([
                'password' => Hash::make($inputs['password']),
                'updated_at' => now(),
            ]);
        }

        // Processing of the base64 image if present
        if ($request->image_64) {
            $replace = substr($request->image_64, 0, strpos($request->image_64, ',') + 1);
            $image = str_replace($replace, '', $request->image_64);
            $image = str_replace(' ', '+', $image);

            $image_path = 'images/users/' . $user->id . '/avatar/' . Str::random(50) . '.png';

            // Upload image
            Storage::disk('public')->put($image_path, base64_decode($image));

            $user->update([
                'avatar_url' => Storage::url($image_path),
                'updated_at' => now()
            ]);
        }

        if ($inputs['status'] != null) {
            $user->update([
                'status' => $inputs['status'],
                'updated_at' => now(),
            ]);
        }

        // Conditional return: AJAX or HTML POST
        return $request->expectsJson()
            ? response()->json(['success' => true, 'message' => __('notifications.updated_data'), 'avatar_url' => $user->avatar_url ?? null])
            : back()->with('success_message', __('notifications.updated_data'));
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
        if ($entity == 'product-sharing') {
            $current_product = Product::find($id);

            $current_product->update([
                'is_shared' => $request->is_shared,
                'updated_by' => Auth::check() ? Auth::id() : null,
            ]);

            return redirect()->back();
        }

        if ($entity == 'product' OR $entity == 'service') {
            $inputs = [
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'currency' => $request->currency,
                'type' => $request->filled('type') ? $request->type : $entity,
                'action' => $request->filled('action') ? $request->action : 'sell',
                'is_shared' => $request->filled('is_shared') ? $request->is_shared : 0,
                'category_id' => $request->category_id,
            ];

            $current_product = Product::find($id);

            if ($inputs['product_name'] != null) {
                $current_product->update([
                    'product_name' => $inputs['product_name'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            if ($inputs['product_description'] != null) {
                $current_product->update([
                    'product_description' => $inputs['product_description'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            if ($inputs['quantity'] != null) {
                $current_product->update([
                    'quantity' => $inputs['quantity'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            if ($inputs['price'] != null) {
                $current_product->update([
                    'price' => $inputs['price'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            if ($inputs['currency'] != null) {
                $current_product->update([
                    'currency' => $inputs['currency'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            if ($inputs['type'] != null) {
                $current_product->update([
                    'type' => $inputs['type'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            if ($inputs['action'] != null) {
                $current_product->update([
                    'action' => $inputs['action'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            if ($inputs['is_shared'] != null) {
                $current_product->update([
                    'is_shared' => $inputs['is_shared'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            if ($inputs['category_id'] != null) {
                $current_product->update([
                    'category_id' => $inputs['category_id'],
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);
            }

            // If image files exist
            if ($request->hasFile('files_urls')) {
                $files = $request->file('files_urls', []);
                $fileNames = $request->input('files_names', []);

                // Types of extensions for different file types
                $video_extensions = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
                $photo_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff', 'tif', 'svg', 'heif', 'heic', 'ico'];
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
                        return response()->json(['status' => 'error', 'message' => __('notifications.type_is_not_file')]);
                    }

                    // Generate a unique path for the file
                    $filename = $singleFile->getClientOriginalName();
                    $file_url =  $custom_uri . '/' . $current_product->id . '/' . $filename;

                    // Upload file
                    try {
                        $singleFile->storeAs($custom_uri . '/' . $current_product->id, $filename, 'public');

                    } catch (\Throwable $th) {
                        return response()->json(['status' => 'error', 'message' => __('notifications.create_work_file_500')]);
                    }

                    // Creating the database record for the file
                    File::create([
                        'file_name' => trim($fileNames[$key] ?? $filename),
                        'file_url' => getWebURL() . '/storage/' . $file_url,
                        'file_type' => $file_type,
                        'product_id' => $current_product->id
                    ]);
                }
            }

            return response()->json(['status' => 'success', 'message' => __('notifications.updated_data')]);
        }

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
                    $inStock = $product->quantity > 0;  // Check if product is in stock
                    $isLoggedIn = true;

                } else {
                    // If user is not connected, we store product in the session
                    $cart = session()->get('cart', []);
                    // Product photos
                    $photos = $product->photos()->pluck('file_url');
                    // Add product in the session cart
                    $cart[$id] = [
                        'id' => $product->id,
                        'product_name' => $product->product_name,
                        'product_description' => $product->product_description,
                        'quantity' => $request->quantity,
                        'price' => $product->currency == 'USD' ? $product->price : $product->convertPrice('USD'),
                        'currency' => $product->currency == 'USD' ? $product->currency : 'USD',
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

        if ($entity == 'update-order-quantity') {
            try {
                // Checking if the user is authenticated
                if (Auth::check()) {
                    $order = CustomerOrder::find($id); // Get the order with the ID passed in the URL

                    if (!$order) {
                        return response()->json([
                            'message' => __('notifications.find_customer_order_404')
                        ], 404);
                    }

                    // Get the product associated with the order
                    $product = $order->product;

                    if (!$product) {
                        return response()->json(['message' => __('notifications.find_product_404')], 404);
                    }

                    $user = User::find(Auth::id());

                    switch ($request->action) {
                        case 'increment':
                            $user->updateProductQuantityInCart($order->id, 1, 'increment');
                            break;

                        case 'decrement':
                            $user->updateProductQuantityInCart($order->id, 1, 'decrement');
                            break;

                        case 'update':
                            if ($request->quantity < 500) {
                                return response()->json([
                                    'message' => __('notifications.minimum_quantity_error'),
                                    'newQuantity' => $order->quantity,
                                    'inStock' => false,
                                ], 400);

                            } else {
                                $user->updateProductQuantityInCart($order->id, $request->quantity, 'update');
                            }
                            break;

                        default:
                            return response()->json([
                                'message' => __('validation.custom.action.required'),
                                'newQuantity' => $order->quantity,
                                'inStock' => false,
                            ], 400);
                    }

                    return response()->json([
                        'message' => __('notifications.update_customer_order_success'),
                        'newQuantity' => $order->quantity,
                        'inCart' => true,
                        'inStock' => $product->quantity > 0,
                    ]);

                } else {
                    $product = Product::find($id);

                    if (!$product) {
                        return response()->json(['message' => __('notifications.find_product_404')], 404);
                    }

                    // If user is not connected, operation is done in the session
                    $cart = session()->get('cart', []);

                    if (!isset($cart[$id])) {
                        return response()->json(['message' => __('notifications.find_cart_404')], 404);
                    }

                    // Vérification de la quantité
                    switch ($request->action) {
                        case 'increment':
                            // Check if stock is sufficient for increment
                            if ($product->quantity <= 0) {
                                return response()->json([
                                    'message' => __('notifications.insufficient_stock', ['product_name' => $product->product_name, 'quantity' => $product->quantity]),
                                    'newQuantity' => $cart[$id]['quantity'],
                                    'inStock' => false,
                                ], 422);

                            } else {
                                // Increment quantity in cart
                                $cart[$id]['quantity']++;
                            }
                            break;

                        case 'decrement':
                            // Check that the quantity in the cart is > 500
                            if ($cart[$id]['quantity'] <= 500) {
                                return response()->json([
                                    'message' => __('notifications.minimum_quantity_error'),
                                    'newQuantity' => $cart[$id]['quantity'],
                                    'inStock' => false,
                                ], 422);

                            } else {
                                // Decrease quantity in cart
                                $cart[$id]['quantity']--;
                            }
                            break;

                        case 'update':
                            // Mise à jour de la quantité
                            if ($request->quantity < 500) {
                                return response()->json([
                                    'message' => __('notifications.minimum_quantity_error'),
                                    'newQuantity' => $cart[$id]['quantity'],
                                    'inStock' => false,
                                ], 400);

                            } else {
                                $cart[$id]['quantity'] = $request->quantity;
                            }
                            break;

                        default:
                            return response()->json([
                                'message' => __('validation.custom.action.required'),
                                'newQuantity' => $cart[$id]['quantity'],
                                'inStock' => false,
                            ], 400);
                    }

                    // Save session with new quantity
                    session()->put('cart', $cart);

                    return response()->json([
                        'message' => __('notifications.update_customer_order_success'),
                        'newQuantity' => $cart[$id]['quantity'],
                        'inCart' => true,
                        'inStock' => true,
                    ]);
                }

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 422);
            }
        }

        if ($entity == 'update-orders-delivery') {
            try {
                // Get the product associated with the order
                $current_cart = Cart::find($id);

                if (!$current_cart) {
                    return response()->json(['success' => false, 'message' => __('notifications.find_cart_404')], 404);
                }

                $current_cart->update([
                    'is_delivered' => $request->is_delivered,
                    'updated_by' => Auth::check() ? Auth::id() : null,
                ]);

                return response()->json(['success' => true, 'message' => __('notifications.updated_data')]);

            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
        }
    }

    /**
     * POST: Update a project
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProject(Request $request, $id)
    {
        // TODO update project
    }

    /**
     * GET: Edit answers part form
     *
     * @param  int $projectId
     * @param  int $partId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editPart($projectId, $partId)
    {
        $project = Project::with(['project_answers', 'project_answers.project_question'])->findOrFail($projectId);
        $part = QuestionPart::with(['project_questions.question_assertions'])->findOrFail($partId);

        // Récupérer les réponses existantes de ce projet pour les questions de cette partie
        $answersByQuestion = $project->project_answers->whereIn('project_question_id', $part->project_questions->pluck('id'))->keyBy('project_question_id');

        return view('projects.part_form', compact('project', 'part', 'answersByQuestion'));
    }

    /**
     * POST: Udpate answers part
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $projectId
     * @param  int $partId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePart(Request $request, $projectId, $partId)
    {
        $project = Project::findOrFail($projectId);
        $part = QuestionPart::with('project_questions')->findOrFail($partId);

        foreach ($part->project_questions as $question) {
            $answerValue = $request->input("answers.{$question->id}");

            if ($answerValue) {
                // Trouve ou crée une réponse
                ProjectAnswer::updateOrCreate(
                    [
                        'project_id' => $project->id,
                        'project_question_id' => $question->id,
                    ],
                    [
                        'answer_content' => is_array($answerValue) ? implode(', ', $answerValue) : $answerValue,
                    ]
                );
            }
        }

        return response()->json(['success' => true]);
    }
}
