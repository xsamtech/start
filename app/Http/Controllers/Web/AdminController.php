<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\ApiClientManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\User as ResourcesUser;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProjectSector;
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

        return view('dashboard.home', [
            'products_unshared' => ResourcesProduct::collection($products_unshared)->resolve(),
            'products_unshared_req' => $products_unshared,
            'products' => ResourcesProduct::collection($products)->resolve(),
            'products_req' => $products,
            'services_unshared' => ResourcesProduct::collection($services_unshared)->resolve(),
            'services_unshared_req' => $services_unshared,
            'services' => ResourcesProduct::collection($services)->resolve(),
            'services_req' => $services,
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
     * GET: Home page
     *
     * @return \Illuminate\View\View
     */
    public function category()
    {
        $sectors = ProjectSector::all();

        return view('dashboard.categories', ['project_sectors' => $sectors]);
    }

    /**
     * GET: Sector details page
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
     * GET: Home page
     *
     * @param  string $entity
     * @return \Illuminate\View\View
     */
    public function categoryEntity($entity)
    {
        $entity_title = null;
        $items = null;

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
            'items' => ResourcesProduct::collection($items)->resolve(),
            'items_req' => $items,
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
