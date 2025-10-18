<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerFeedback as ResourcesCustomerFeedback;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\Project as ResourcesProject;
use App\Http\Resources\ProjectQuestion as ResourcesProjectQuestion;
use App\Http\Resources\QuestionAssertion as ResourcesQuestionAssertion;
use App\Http\Resources\QuestionPart as ResourcesQuestionPart;
use App\Http\Resources\Role as ResourcesRole;
use App\Http\Resources\User as ResourcesUser;
use App\Models\Category;
use App\Models\CustomerFeedback;
use App\Models\PasswordReset;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectQuestion;
use App\Models\ProjectSector;
use App\Models\QuestionAssertion;
use App\Models\QuestionPart;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class AdminController extends Controller
{
    public static $api_client_manager;
    protected $currentUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            /** @var User $user */
            $user = Auth::user();

            if (!$user || !$user->isAdmin()) {
                abort(403);
            }

            return $next($request);
        });
    }

    // ==================================== HTTP GET METHODS ====================================
    /**
     * GET: Home page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Retrieve the 'month' and 'year' parameters from the query
        $month = $request->get('month');
        $year = $request->get('year');

        // Statistics for "products" and "projects"
        $products_unshared = Product::where('type', 'product')->where('is_shared', 0)->orderByDesc('created_at')->paginate(20)->appends($request->query());
        $products = Product::where('type', 'product')->orderByDesc('created_at')->paginate(20)->appends($request->query());
        $services_unshared = Product::where('type', 'service')->where('is_shared', 0)->orderByDesc('created_at')->paginate(20)->appends($request->query());
        $services = Product::where('type', 'service')->orderByDesc('created_at')->paginate(20)->appends($request->query());
        $projects_unshared = Project::where('is_shared', 0)->orderByDesc('created_at')->paginate(20)->appends($request->query());
        $projects = Project::orderByDesc('created_at')->paginate(20)->appends($request->query());
        // Récupérer les paiements filtrés avec leurs paniers
        $payments = $request->has('status') 
                        ? Payment::with('cart')->where('status', $request->get('status'))->filterByMonthAndYear($month, $year)->orderByDesc('created_at')->paginate(20)->appends($request->query())
                        : Payment::with('cart')->filterByMonthAndYear($month, $year)->orderByDesc('created_at')->paginate(20)->appends($request->query());
        // Regrouper les paiements par semaine
        $paymentsByWeek = $payments->groupBy(function($payment) {
            return $payment->created_at->format('o-W'); // o-W : Année-Semaine (par exemple 2025-23)
        });

        // Préparer les données pour le graphique
        $chartData = [
            'labels' => [],
            'data' => [],
        ];

        foreach ($paymentsByWeek as $week => $weekPayments) {
            $chartData['labels'][] = __('miscellaneous.period.word.week') . ' ' . substr($week, 5); // Extrait le numéro de la semaine (ex: "23")
            $chartData['data'][] = $weekPayments->count(); // Compte le nombre de paiements pour chaque semaine
        }

        // Si la collection est vide, initialiser les variables à 0
        if ($payments->isEmpty()) {
            $ongoingAmount = $doneAmount = $canceledAmount = $totalAmount = 0;
            $ongoingPercentage = $donePercentage = $canceledPercentage = 0;

        } else {
            // Calculer les montants par statut
            $ongoingAmount = $payments->first()->convertAmountSum(1);
            $doneAmount = $payments->first()->convertAmountSum(0);
            $canceledAmount = $payments->first()->convertAmountSum(2);

            // Calculer le montant total du mois
            $totalAmount = $payments->first()->convertAmountSum(null);  // Si tu veux le montant total sans statut spécifique

            // Calculer les pourcentages pour les barres de progression
            // On vérifie ici que le totalAmount n'est pas 0 pour éviter la division par zéro
            if ($totalAmount > 0) {
                $ongoingPercentage = ($ongoingAmount / $totalAmount) * 100;
                $donePercentage = ($doneAmount / $totalAmount) * 100;
                $canceledPercentage = ($canceledAmount / $totalAmount) * 100;
            } else {
                $ongoingPercentage = $donePercentage = $canceledPercentage = 0;
            }
        }

        // Préparer les données pour la vue
        $statistics = [
            'ongoing' => [
                'amount' => $ongoingAmount,
                'percentage' => $ongoingPercentage
            ],
            'done' => [
                'amount' => $doneAmount,
                'percentage' => $donePercentage
            ],
            'canceled' => [
                'amount' => $canceledAmount,
                'percentage' => $canceledPercentage
            ]
        ];

        return view('dashboard.home', [
            'products_unshared' => ResourcesProduct::collection($products_unshared)->resolve(),
            'products_unshared_req' => $products_unshared,
            'products' => ResourcesProduct::collection($products)->resolve(),
            'products_req' => $products,
            'services_unshared' => ResourcesProduct::collection($services_unshared)->resolve(),
            'services_unshared_req' => $services_unshared,
            'services' => ResourcesProduct::collection($services)->resolve(),
            'services_req' => $services,
            'projects_unshared' => ResourcesProject::collection($projects_unshared)->resolve(),
            'projects_unshared_req' => $projects_unshared,
            'projects' => ResourcesProject::collection($projects)->resolve(),
            'projects_req' => $projects,
            'payments' => $payments,
            'chartData' => $chartData,
            'statistics' => $statistics,
            'totalAmount' => $totalAmount,
        ]);
    }

    /**
     * GET: Roles page
     *
     * @return \Illuminate\View\View
     */
    public function role()
    {
        $roles = Role::all();

        return view('dashboard.roles', [
            'roles' => ResourcesRole::collection($roles)->resolve()
        ]);
    }

    /**
     * GET: Role entity page
     *
     * @param  string $entity
     * @return \Illuminate\View\View
     */
    public function roleEntity($entity)
    {
        $entity_title = null;
        $items_req = [];
        $items = [];

        if ($entity == 'users') {
            $entity_title = __('miscellaneous.admin.users.link');
            $roles = Role::all();
            // Si `role_id` est présent dans la requête
            if (request()->has('role_id')) {
                // Récupérer les utilisateurs ayant ce `role_id` et `is_selected = 1`
                $roleId = request()->get('role_id');
                $items_req = User::whereHas('roles', function ($query) use ($roleId) {
                    $query->where('role_user.role_id', $roleId)
                        ->where('role_user.is_selected', 1);
                })
                ->where('id', '<>', Auth::id()) // Exclure l'utilisateur connecté
                ->orderByDesc('created_at')
                ->paginate(20)
                ->appends(request()->query()); // Ajouter les paramètres de la requête pour la pagination

            } else {
                // Si `role_id` n'est pas présent, on récupère tous les utilisateurs sauf l'utilisateur connecté
                $items_req = User::where('id', '<>', Auth::id())
                                ->orderByDesc('created_at')
                                ->paginate(20)
                                ->appends(request()->query());
            }

            $items = ResourcesUser::collection($items_req)->resolve();
        }

        return view('dashboard.roles', [
            'entity' => $entity,
            'entity_title' => $entity_title,
            'roles' => ResourcesRole::collection($roles)->resolve(),
            'items' => $items,
            'items_req' => $items_req,
        ]);
    }

    /**
     * GET: Role entity datas
     *
     * @param  string $entity
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function roleEntityDatas($entity, $id)
    {
        $entity_title = null;
        $selected_entity = null;

        if ($entity == 'role') {
            $role = Role::find($id);

            if (!$role) {
                return redirect('/dashboard/role')->with('error_message', __('notifications.find_role_404'));
            }

            $selected_entity = (new ResourcesRole($role))->resolve();
        }

        if ($entity == 'users') {
            $entity_title = __('miscellaneous.admin.users.details');
            $user = User::find($id);

            if (!$user) {
                return redirect('/dashboard/role/users')->with('error_message', __('notifications.find_user_404'));
            }

            $selected_entity = (new ResourcesUser($user))->resolve();
        }

        return view('dashboard.roles', [
            'entity' => $entity,
            'entity_title' => $entity_title,
            'selected_entity' => $selected_entity,
        ]);
    }

    /**
     * GET: Sectors page
     *
     * @return \Illuminate\View\View
     */
    public function sector()
    {
        return view('dashboard.sectors');
    }

    /**
     * GET: Sector details page
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function sectorDatas($id)
    {
        $selected_sector = ProjectSector::find($id);

        if (is_null($selected_sector)) {
            return redirect()->route('dashboard.sector.home')->with('error_message', __('notifications.404_title'));
        }

        return view('dashboard.sectors', ['selected_sector' => $selected_sector]);
    }

    /**
     * GET: Categories page
     *
     * @return \Illuminate\View\View
     */
    public function category()
    {
        $sectors = ProjectSector::all();

        return view('dashboard.categories', ['project_sectors' => $sectors]);
    }

    /**
     * GET: Category details page
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function categoryDatas($id)
    {
        $sectors = ProjectSector::all();
        $selected_category = Category::find($id);

        if (is_null($selected_category)) {
            return redirect()->route('dashboard.sector.home')->with('error_message', __('notifications.find_category_404'));
        }

        return view('dashboard.categories', [
            'project_sectors' => $sectors,
            'selected_category' => $selected_category,
        ]);
    }

    /**
     * GET: Category entity page
     *
     * @param  string $entity
     * @return \Illuminate\View\View
     */
    public function categoryEntity($entity)
    {
        $entity_title = null;
        $items = null;

        if ($entity == 'project') {
            $entity_title = __('miscellaneous.menu.admin.categories.projects');
            $items = Project::orderByDesc('created_at')->paginate(5)->appends(request()->query());
        }

        if ($entity == 'product') {
            $entity_title = __('miscellaneous.menu.public.products.products');
            $items = Product::where('type', 'product')->orderByDesc('created_at')->paginate(5)->appends(request()->query());
        }

        if ($entity == 'service') {
            $entity_title = __('miscellaneous.menu.public.products.services');
            $items = Product::where('type', 'service')->orderByDesc('created_at')->paginate(5)->appends(request()->query());
        }

        return view('dashboard.categories', [
            'entity' => $entity,
            'entity_title' => $entity_title,
            'items' => $entity == 'project' ? ResourcesProject::collection($items)->resolve() : ResourcesProduct::collection($items)->resolve(),
            'items_req' => $items,
        ]);
    }

    /**
     * GET: Questionnaire page
     *
     * @return \Illuminate\View\View
     */
    public function questionnaire()
    {
        $question_parts = QuestionPart::all();
        $project_questions = request()->has('query') ? ProjectQuestion::where('question_content->' . request()->get('language'), 'LIKE', '%' . request()->get('query') . '%')->paginate(20)->appends(request()->query()) : ProjectQuestion::paginate(20)->appends(request()->query());
        $project_questions_all = ProjectQuestion::all();

        return view('dashboard.questionnaire', [
            'question_parts' => ResourcesQuestionPart::collection($question_parts)->resolve(),
            'project_questions' => ResourcesProjectQuestion::collection($project_questions)->resolve(),
            'project_questions_req' => $project_questions,
            'project_questions_all' => ResourcesProjectQuestion::collection($project_questions_all)->resolve(),
        ]);
    }

    /**
     * GET: Questionnaire entity datas page
     *
     * @param  string  $entity
     * @return \Illuminate\View\View
     */
    public function questionnaireEntity($entity)
    {
        $entity_title = null;
        $items = [];
        $items_req = [];
        $project_questions = ProjectQuestion::all();

        if ($entity == 'part') {
            $entity_title = __('miscellaneous.menu.admin.questionnaire.parts.title');
            $items_req = QuestionPart::paginate(10)->appends(request()->query());
            $items = ResourcesQuestionPart::collection($items_req)->resolve();
        }

        if ($entity == 'project') {
            $entity_title = __('miscellaneous.menu.admin.categories.projects');
            $items_req = Project::orderByDesc('updated_at')->paginate(10)->appends(request()->query());
            $items = ResourcesProject::collection($items_req)->resolve();
        }

        return view('dashboard.questionnaire', [
            'entity' => $entity,
            'entity_title' => $entity_title,
            'items' => $items,
            'items_req' => $items_req,
            'project_questions' => ResourcesProjectQuestion::collection($project_questions)->resolve(),
        ]);
    }

    /**
     * GET: Questionnaire entity datas page
     *
     * @param  string  $entity
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function questionnaireEntityDatas($entity, $id)
    {
        $entity_title = null;
        $selected_entity = null;
        $question_parts = QuestionPart::all();
        $project_questions = ProjectQuestion::all();

        if ($entity == 'part') {
            $entity_title = __('miscellaneous.menu.admin.questionnaire.parts.details');
            $question_part = QuestionPart::find($id);

            if (is_null($question_part)) {
                return redirect('/dashboard/questionnaire')->with('error_message', __('notifications.find_question_part_404'));
            }

            $selected_entity = (new ResourcesQuestionPart($question_part))->resolve();
        }

        if ($entity == 'question') {
            $entity_title = __('miscellaneous.menu.admin.questionnaire.questions.details');
            $project_question = ProjectQuestion::find($id);

            if (is_null($project_question)) {
                return redirect('/dashboard/questionnaire')->with('error_message', __('notifications.find_project_question_404'));
            }

            $selected_entity = (new ResourcesProjectQuestion($project_question))->resolve();
        }

        if ($entity == 'assertion') {
            $entity_title = __('miscellaneous.menu.admin.questionnaire.assertions.details');
            $question_assertion = QuestionAssertion::find($id);

            if (is_null($question_assertion)) {
                return redirect('/dashboard/questionnaire/assertion')->with('error_message', __('notifications.find_question_assertion_404'));
            }

            $selected_entity = (new ResourcesQuestionAssertion($question_assertion))->resolve();
        }

        if ($entity == 'assertions-question') {
            $assertions = QuestionAssertion::where('project_question_id', $id)->get();

            return ResourcesQuestionAssertion::collection($assertions);
        }

        if ($entity == 'project') {
            $entity_title = __('miscellaneous.admin.project_writing.details');
            $project = Project::find($id);

            if (is_null($project)) {
                return redirect('/dashboard/questionnaire/project')->with('error_message', __('notifications.find_project_404'));
            }

            $selected_entity = (new ResourcesProject($project))->resolve();
        }

        return view('dashboard.questionnaire', [
            'entity' => $entity,
            'entity_title' => $entity_title,
            'selected_entity' => $selected_entity,
            'question_parts' => ResourcesQuestionPart::collection($question_parts)->resolve(),
            'project_questions' => ResourcesProjectQuestion::collection($project_questions)->resolve(),
        ]);
    }

    /**
     * GET: Complaints page
     *
     * @return \Illuminate\View\View
     */
    public function complaints()
    {
        $customer_feedbacks = CustomerFeedback::whereNotNull('for_product_id')->whereNotNull('comment')->paginate(20)->appends(request()->query());

        return view('dashboard.complaints', [
            'customer_feedbacks' => ResourcesCustomerFeedback::collection($customer_feedbacks)->resolve(),
            'customer_feedbacks_req' => $customer_feedbacks,
        ]);
    }

    /**
     * GET: Complaint datas page
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function complaintsDatas($id)
    {
        $customer_feedback = CustomerFeedback::find($id);

        if (is_null($customer_feedback)) {
            return redirect()->with('error_message', __('notifications.find_message_404'));
        }

        return view('dashboard.complaints', [
            'customer_feedback' => new ResourcesCustomerFeedback($customer_feedback),
        ]);
    }

    // ==================================== HTTP POST METHODS ====================================
    /**
     * POST: Add a role
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function addRole(Request $request)
    {
        Role::create([
            'role_name' => [
                'en' => $request->role_name_en,
                'fr' => $request->role_name_fr
            ],
            'role_description' => [
                'en' => $request->role_description_en,
                'fr' => $request->role_description_fr
            ],
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success_message', __('notifications.registered_data'));
    }

    /**
     * POST: Add a role entity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $entity
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function addRoleEntity(Request $request, $entity)
    {
        if ($entity == 'admins') {
            $random_int_stringified = (string) random_int(1000000, 9999999);
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'surname' => $request->surname,
                'about_me' => $request->about_me,
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
                'currency' => !empty($request->currency) ? $request->currency : 'USD',
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->username,
                'status' => !empty($request->status) ? $request->status : 'activated',
                'password' => Hash::make($request->password),
            ]);

            // Register password reset data
            PasswordReset::create([
                'email' => $request->email,
                'phone' => $request->phone,
                'token' => $random_int_stringified,
                'former_password' => $request->password
            ]);

            $role_admin_exists = Role::where('role_name->fr', 'Administrateur')->exists();

            if (!$role_admin_exists) {
                // Add "Administrateur" role (the first role)
                $role_admin = Role::create([
                    'role_name' => [
                        'en' => 'Administrator',
                        'fr' => 'Administrateur',
                    ],
                    'role_description' => [
                        'en' => 'Responsible for managing the operation of the platform.',
                        'fr' => 'Responsable de la gestion du fonctionnement de la plateforme.',
                    ]
                ]);

            } else {
                $role_admin = Role::where('role_name->fr', 'Administrateur')->first();
            }

            // Register user with role
            $user->roles()->attach($role_admin->id, ['is_selected' => 1]);

            if (isset($request->image_64)) {
                // $extension = explode('/', explode(':', substr($request->image_64, 0, strpos($request->image_64, ';')))[1])[1];
                $replace = substr($request->image_64, 0, strpos($request->image_64, ',') + 1);
                // Find substring from replace here eg: data:image/png;base64,
                $image = str_replace($replace, '', $request->image_64);
                $image = str_replace(' ', '+', $image);
                // Create image URL
                $image_path = 'images/users/' . $user->id . '/avatar/' . Str::random(50) . '.png';

                // Upload image
                Storage::disk('public')->put($image_path, base64_decode($image));

                $user->update([
                    'avatar_url' => Storage::url($image_path),
                    'updated_at' => now()
                ]);
            }

            // The API token
            $token = $user->createToken('auth_token')->plainTextToken;

            $user->update([
                'api_token' => $token,
                'updated_at' => now()
            ]);
        }

        return response()->json(['status' => 'success', 'message' => __('notifications.registered_data')]);
    }

    /**
     * POST: Add a sector
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function addSector(Request $request)
    {
        ProjectSector::create([
            'sector_name' => [
                'en' => $request->sector_name_en,
                'fr' => $request->sector_name_fr
            ],
            'sector_description' => [
                'en' => $request->sector_description_en,
                'fr' => $request->sector_description_fr
            ],
        ]);

        // return response()->json(['status' => 'success', 'message' => __('notifications.registered_data')]);
        return redirect()->back()->with('success_message', __('notifications.registered_data'));
    }

    /**
     * POST: Add a sector
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $entity
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function addQuestionnaireEntity(Request $request, $entity)
    {
        if ($entity == 'part') {
            QuestionPart::create([
                'part_name' => [
                    'en' => $request->part_name_en,
                    'fr' => $request->part_name_fr
                ],
                'part_description' => [
                    'en' => $request->part_description_en,
                    'fr' => $request->part_description_fr
                ],
                'is_first_step' => $request->is_first_step,
                'is_last_step' => $request->is_last_step,
            ]);
        }

        if ($entity == 'question') {
            ProjectQuestion::create([
                'question_content' => [
                    'en' => $request->question_content_en,
                    'fr' => $request->question_content_fr
                ],
                'question_description' => [
                    'en' => $request->question_description_en,
                    'fr' => $request->question_description_fr
                ],
                'multiple_answers_required' => $request->multiple_answers_required,
                'input' => $request->input,
                'word_limit' => $request->word_limit,
                'character_limit' => $request->character_limit,
                'belongs_to' => $request->belongs_to,
                'linked_assertion' => $request->linked_assertion,
                'measurment_units_required' => $request->measurment_units_required,
                'question_part_id' => $request->question_part_id,
            ]);
        }

        if ($entity == 'assertion') {
            QuestionAssertion::create([
                'assertion_content' => [
                    'en' => $request->assertion_content_en,
                    'fr' => $request->assertion_content_fr
                ],
                'belongs_to_required' => $request->belongs_to_required,
                'project_question_id' => $request->project_question_id,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => __('notifications.registered_data')]);
        // return redirect()->back()->with('success_message', __('notifications.registered_data'));
    }

    /**
     * POST: Update a sector
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function updateSector(Request $request, $id)
    {
        $sector = ProjectSector::find($id);

        if (is_null($sector)) {
            return redirect()->back()->with('error_message', __('notifications.404_title'));
        }

        if ($request->has('sector_name_en') AND $request->sector_name_en != $sector->getTranslation('sector_name', 'en')) {
            $sector->setTranslation('sector_name', 'en', $request->sector_name_en);
        }

        if ($request->has('sector_name_fr') AND $request->sector_name_fr != $sector->getTranslation('sector_name', 'fr')) {
            $sector->setTranslation('sector_name', 'fr', $request->sector_name_fr);
        }

        if ($request->has('sector_description_en') AND $request->sector_description_en != $sector->getTranslation('sector_description', 'en')) {
            $sector->setTranslation('sector_description', 'en', $request->sector_description_en);
        }

        if ($request->has('sector_description_fr') AND $request->sector_description_fr != $sector->getTranslation('sector_description', 'fr')) {
            $sector->setTranslation('sector_description', 'fr', $request->sector_description_fr);
        }

        $sector->save();

        return redirect()->back()->with('success_message', __('notifications.updated_data'));
    }

    /**
     * POST: Add a sector
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $entity
     * @param  int $id
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function updateQuestionnaireEntity(Request $request, $entity, $id)
    {
        if ($entity == 'part') {
            $inputs = [
                'id' => $id,
                'part_name' => [
                    'en' => $request->part_name_en,
                    'fr' => $request->part_name_fr
                ],
                'part_description' => [
                    'en' => $request->part_description_en,
                    'fr' => $request->part_description_fr
                ],
                'is_first_step' => $request->is_first_step,
                'is_last_step' => $request->is_last_step,
            ];
            $current_part = QuestionPart::find($inputs['id']);

            if ($inputs['part_name'] != null) {
                $current_part->update([
                    'part_name' => $inputs['part_name'],
                ]);
            }

            if ($inputs['part_description'] != null) {
                $current_part->update([
                    'part_description' => $inputs['part_description'],
                ]);
            }

            if ($inputs['is_first_step'] != null) {
                $current_part->update([
                    'is_first_step' => $inputs['is_first_step'],
                ]);
            }

            if ($inputs['is_last_step'] != null) {
                $current_part->update([
                    'is_last_step' => $inputs['is_last_step'],
                ]);
            }
        }

        if ($entity == 'question') {
            $inputs = [
                'id' => $id,
                'question_content' => [
                    'en' => $request->question_content_en,
                    'fr' => $request->question_content_fr
                ],
                'question_description' => [
                    'en' => $request->question_description_en,
                    'fr' => $request->question_description_fr
                ],
                'multiple_answers_required' => $request->multiple_answers_required,
                'input' => $request->input,
                'word_limit' => $request->word_limit,
                'character_limit' => $request->character_limit,
                'belongs_to' => $request->belongs_to,
                'linked_assertion' => $request->linked_assertion,
                'measurment_units_required' => $request->measurment_units_required,
                'question_part_id' => $request->question_part_id,
            ];
            $current_question = ProjectQuestion::find($inputs['id']);

            if ($inputs['question_content'] != null) {
                $current_question->update([
                    'question_content' => $inputs['question_content'],
                ]);
            }

            if ($inputs['question_description'] != null) {
                $current_question->update([
                    'question_description' => $inputs['question_description'],
                ]);
            }

            if ($inputs['multiple_answers_required'] != null) {
                $current_question->update([
                    'multiple_answers_required' => $inputs['multiple_answers_required'],
                ]);
            }

            if ($inputs['input'] != null) {
                $current_question->update([
                    'input' => $inputs['input'],
                ]);
            }

            if ($inputs['word_limit'] != null) {
                $current_question->update([
                    'word_limit' => $inputs['word_limit'],
                ]);
            }

            if ($inputs['character_limit'] != null) {
                $current_question->update([
                    'character_limit' => $inputs['character_limit'],
                ]);
            }

            if ($inputs['belongs_to'] != null) {
                $current_question->update([
                    'belongs_to' => $inputs['belongs_to'],
                ]);
            }

            if ($inputs['linked_assertion'] != null) {
                $current_question->update([
                    'linked_assertion' => $inputs['linked_assertion'],
                ]);
            }

            if ($inputs['measurment_units_required'] != null) {
                $current_question->update([
                    'measurment_units_required' => $inputs['measurment_units_required'],
                ]);
            }

            if ($inputs['question_part_id'] != null) {
                $current_question->update([
                    'question_part_id' => $inputs['question_part_id'],
                ]);
            }
        }

        if ($entity == 'assertion') {
            $inputs = [
                'id' => $id,
                'assertion_content' => [
                    'en' => $request->assertion_content_en,
                    'fr' => $request->assertion_content_fr
                ],
                'belongs_to_required' => $request->belongs_to_required,
                'project_question_id' => $request->project_question_id,
            ];
            $current_assertion = QuestionAssertion::find($inputs['id']);

            if ($inputs['assertion_content'] != null) {
                $current_assertion->update([
                    'assertion_content' => $inputs['assertion_content'],
                ]);
            }

            if ($inputs['belongs_to_required'] != null) {
                $current_assertion->update([
                    'belongs_to_required' => $inputs['belongs_to_required'],
                ]);
            }

            if ($inputs['project_question_id'] != null) {
                $current_assertion->update([
                    'project_question_id' => $inputs['project_question_id'],
                ]);
            }
        }

        if ($entity == 'project') {
            $inputs = [
                'id' => $id,
                'project_description' => $request->project_description,
                'is_shared' => $request->is_shared,
                'user_id' => $request->user_id,
            ];
            $current_project = Project::find($inputs['id']);

            if ($inputs['project_description'] != null) {
                $current_project->update([
                    'project_description' => $inputs['project_description'],
                ]);
            }

            if ($inputs['is_shared'] != null) {
                $current_project->update([
                    'is_shared' => $inputs['is_shared'],
                ]);
            }

            if ($inputs['user_id'] != null) {
                $current_project->update([
                    'user_id' => $inputs['user_id'],
                ]);
            }

            return redirect()->back()->with('success_message', __('notifications.updated_data'));
        }

        return response()->json(['status' => 'success', 'message' => __('notifications.updated_data')]);
    }

    /**
     * POST: Add a category
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function addCategory(Request $request)
    {
        $category = Category::create([
            'category_name' => [
                'en' => $request->category_name_en,
                'fr' => $request->category_name_fr
            ],
            'category_description' => [
                'en' => $request->category_description_en,
                'fr' => $request->category_description_fr
            ],
            'for_service' => $request->for_service,
            'alias' => $request->alias,
            'project_sector_id' => $request->project_sector_id,
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

        return redirect()->back()->with('success_message', __('notifications.registered_data'));
    }

    /**
     * POST: Update a category
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return redirect()->back()->with('error_message', __('notifications.404_title'));
        }

        if ($request->has('category_name_en') AND $request->category_name_en != $category->getTranslation('category_name', 'en')) {
            $category->setTranslation('category_name', 'en', $request->category_name_en);
        }

        if ($request->has('category_name_fr') AND $request->category_name_fr != $category->getTranslation('category_name', 'fr')) {
            $category->setTranslation('category_name', 'fr', $request->category_name_fr);
        }

        if ($request->has('category_description_en') AND $request->category_description_en != $category->getTranslation('category_description', 'en')) {
            $category->setTranslation('category_description', 'en', $request->category_description_en);
        }

        if ($request->has('category_description_fr') AND $request->category_description_fr != $category->getTranslation('category_description', 'fr')) {
            $category->setTranslation('category_description', 'fr', $request->category_description_fr);
        }

        if ($request->has('for_service') AND $request->for_service != $category->for_service) {
            $category->for_service = $request->for_service;
        }

        if ($request->has('alias') AND $request->alias != $category->alias) {
            $category->alias = $request->alias;
        }

        if ($request->has('project_sector_id') AND $request->project_sector_id != $category->project_sector_id) {
            $category->project_sector_id = $request->project_sector_id;
        }

        if ($request->filled('image_64')) {
            // $extension = explode('/', explode(':', substr($request->image_64, 0, strpos($request->image_64, ';')))[1])[1];
            $replace = substr($request->image_64, 0, strpos($request->image_64, ',') + 1);
            // Find substring from replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $request->image_64);
            $image = str_replace(' ', '+', $image);
            // Create image URL
            $image_path = 'images/categories/' . $category->id . '/' . Str::random(50) . '.png';

            // Upload image
            Storage::disk('public')->put($image_path, base64_decode($image));

            $category->image_url = Storage::url($image_path);
        }

        $category->save();

        return redirect()->back()->with('success_message', __('notifications.updated_data'));
    }

    /**
     * POST: Update a role entity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $entity
     * @param  int  $id
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function updateRoleEntity(Request $request, $entity, $id)
    {
        if ($entity == 'users') {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => __('notifications.find_user_404')], 404);
            }

            $roleId = $request->input('role_id');

            if (!$roleId) {
                return response()->json(['message' => 'Le rôle est requis.'], 400);
            }

            $role = Role::find($roleId);

            if (!$role) {
                return response()->json(['message' => __('notifications.find_role_404')], 404);
            }

            DB::beginTransaction();

            try {
                // 1. Vérifier si un rôle est déjà sélectionné avec `is_selected = 0`
                $existingPivot = $user->roles()->wherePivot('is_selected', 0)->first();

                if ($existingPivot) {
                    // D'abord, on met tous les autres rôles à `is_selected = 0`
                    $user->roles()->updateExistingPivot($user->roles->pluck('id')->toArray(), ['is_selected' => 0]);
                    // Puis, si un pivot avec `is_selected = 0` existe, on le met à 1
                    $user->roles()->updateExistingPivot($existingPivot->id, ['is_selected' => 1]);

                } else {
                    // 2. Si aucun pivot avec `is_selected = 0` n'existe, on ajoute un nouveau rôle et on le définit à 1
                    // D'abord, on met tous les autres rôles à `is_selected = 0`
                    $user->roles()->updateExistingPivot($user->roles->pluck('id')->toArray(), ['is_selected' => 0]);
                    // Puis on attache le nouveau rôle avec `is_selected = 1`
                    $user->roles()->attach($roleId, ['is_selected' => 1]);
                }

                DB::commit();

                return response()->json(['success' => true, 'message' => __('notifications.update_role_success')]);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }

        if ($entity == 'user-status') {
            $status = $request->input('status');
            $user = User::find($id);

            if (!$user) {
                return redirect()->back()->with('error_message', __('notifications.find_user_404'));
            }

            DB::beginTransaction();

            try {
                $user->update(['status' => $status]);

                DB::commit();

                return redirect()->back()->with('success_message', __('notifications.update_status_success'));
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->back()->with('error_message', $e->getMessage());
            }
        }
    }
}
