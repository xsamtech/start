<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\ApiClientManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\Project as ResourcesProject;
use App\Http\Resources\ProjectQuestion as ResourcesProjectQuestion;
use App\Http\Resources\QuestionAssertion as ResourcesQuestionAssertion;
use App\Http\Resources\QuestionPart as ResourcesQuestionPart;
use App\Http\Resources\User as ResourcesUser;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectQuestion;
use App\Models\ProjectSector;
use App\Models\QuestionAssertion;
use App\Models\QuestionPart;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products_unshared = Product::where('type', 'product')->where('is_shared', 0)->orderByDesc('created_at')->paginate(5)->appends(request()->query());
        $products = Product::where('type', 'product')->orderByDesc('created_at')->paginate(5)->appends(request()->query());
        $services_unshared = Product::where('type', 'service')->where('is_shared', 0)->orderByDesc('created_at')->paginate(5)->appends(request()->query());
        $services = Product::where('type', 'service')->orderByDesc('created_at')->paginate(5)->appends(request()->query());
        $projects = Project::orderByDesc('created_at')->paginate(5)->appends(request()->query());

        return view('dashboard.home', [
            'products_unshared' => ResourcesProduct::collection($products_unshared)->resolve(),
            'products_unshared_req' => $products_unshared,
            'products' => ResourcesProduct::collection($products)->resolve(),
            'products_req' => $products,
            'services_unshared' => ResourcesProduct::collection($services_unshared)->resolve(),
            'services_unshared_req' => $services_unshared,
            'services' => ResourcesProduct::collection($services)->resolve(),
            'services_req' => $services,
            'projects' => ResourcesProject::collection($projects)->resolve(),
            'projects_req' => $projects,
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
        $project_questions = ProjectQuestion::paginate(20)->appends(request()->query());
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
        $project_questions = ProjectQuestion::all();

        if ($entity == 'part') {
            $entity_title = __('miscellaneous.menu.admin.questionnaire.parts.title');
            $question_parts = QuestionPart::paginate(10)->appends(request()->query());
            $items = ResourcesQuestionPart::collection($question_parts)->resolve();
        }

        if ($entity == 'assertion') {
            $entity_title = __('miscellaneous.menu.admin.questionnaire.assertions.title');
            $question_assertions = QuestionAssertion::paginate(10)->appends(request()->query());
            $items = ResourcesQuestionAssertion::collection($question_assertions)->resolve();
        }

        if ($entity == 'project') {
            $entity_title = __('miscellaneous.menu.admin.categories.projects');
            $projects = Project::paginate(10)->appends(request()->query());
            $items = ResourcesProject::collection($projects)->resolve();
        }

        return view('dashboard.questionnaire', [
            'entity' => $entity,
            'entity_title' => $entity_title,
            'items' => $items,
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
            $entity_title = __('miscellaneous.menu.admin.questionnaire.assertion.details');
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

    // ==================================== HTTP POST METHODS ====================================
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

        return response()->json(['status' => 'success', 'message' => __('notifications.updated_data')]);
        // return redirect()->back()->with('success_message', __('notifications.registered_data'));
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

            DB::beginTransaction();

            try {
                // 1. Update all other roles for this user and set is_selected to 0
                $user->roles()->updateExistingPivot($user->roles->pluck('id')->toArray(), ['is_selected' => 0]);
                // 2. Add the new role and set is_selected to 1
                $user->roles()->attach($request->role_id, ['is_selected' => 1]);

                DB::commit();

                return response()->json(['message' => 'Rôle ajouté avec succès.']);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(['message' => 'Une erreur est survenue.', 'error' => $e->getMessage()], 500);
            }
        }
    }
}
