<?php

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/symlink', [PublicController::class, 'symlink'])->name('symlink');
Route::post('/search', [PublicController::class, 'search'])->name('search');
Route::get('/cart', [PublicController::class, 'cart'])->name('cart');
Route::get('/terms_of_use', [PublicController::class, 'termsOfUse'])->name('terms');
Route::get('/privacy_policy', [PublicController::class, 'privacyPolicy'])->name('privacy');
Route::get('/profile/{id}', [PublicController::class, 'profile'])->whereNumber('id')->name('profile');
Route::get('/change-lang/{locale}', [PublicController::class, 'changeLanguage'])->name('change_language');
// Products
Route::get('/products', [PublicController::class, 'products'])->name('product.home');
Route::get('/products/{entity}', [PublicController::class, 'productEntity'])->name('product.entity');
Route::post('/products/{entity}', [PublicController::class, 'addProductEntity']);
Route::get('/products/{entity}/{id}', [PublicController::class, 'productDatas'])->whereNumber('id')->name('product.entity.datas');
Route::post('/products/{entity}/{id}', [PublicController::class, 'updateProductEntity'])->whereNumber('id');
// Discussions
Route::get('/discussions', [PublicController::class, 'discussions'])->name('discussion.home');
Route::get('/discussions/{id}', [PublicController::class, 'discussionDatas'])->whereNumber('id')->name('discussion.datas');
// Investors
Route::get('/investors', [PublicController::class, 'investors'])->name('investor.home');
Route::get('/investors/{id}', [PublicController::class, 'investorDatas'])->whereNumber('id')->name('investor.datas');
// Crowdfundings
Route::get('/project-writing', [PublicController::class, 'crowdfunding'])->name('crowdfunding.home');
Route::get('/project-writing/{id}', [PublicController::class, 'crowdfundingDatas'])->whereNumber('id')->name('crowdfunding.datas');
// Payment
Route::get('/pay', [PublicController::class, 'pay'])->name('pay');
Route::post('/pay', [PublicController::class, 'runPay']);
Route::get('/transaction_waiting', [PublicController::class, 'transactionWaiting'])->name('transaction.waiting');
Route::get('/transaction_message/{orderNumber}', [PublicController::class, 'transactionMessage'])->name('transaction.message');
Route::get('/paid/{amount}/{currency}/{code}/{entity}/{entity_id}', [PublicController::class, 'paid'])->whereNumber(['amount', 'code', 'cart_id'])->name('paid');
// Delete something
Route::delete('/delete/{entity}/{id}', [PublicController::class, 'removeData'])->whereNumber('id')->name('data.delete');

Route::middleware('auth')->group(function () {
    Route::get('/change-currency/{currency}', [PublicController::class, 'changeCurrency'])->name('change_currency');
    Route::get('/generate-sheet/{user_id}/{language}', [PublicController::class, 'generateSheet'])->whereNumber('user_id')->name('generate_sheet');

    // Products
    Route::post('/products', [PublicController::class, 'addProduct']);
    // Discussions
    Route::post('/discussions', [PublicController::class, 'addDiscussion']);
    Route::post('/discussions/{id}', [PublicController::class, 'updateDiscussion'])->whereNumber('id');
    // Project writing
    Route::post('/project-writing', [PublicController::class, 'addProject']);
    Route::post('/project-writing/{id}', [PublicController::class, 'updateProject'])->whereNumber('id');
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.home');
    // Roles
    Route::get('/dashboard/role', [AdminController::class, 'role'])->name('dashboard.role.home');
    Route::post('/dashboard/role', [AdminController::class, 'addRole']);
    Route::get('/dashboard/role/{id}', [AdminController::class, 'roleDatas'])->whereNumber('id')->name('dashboard.role.datas');
    Route::post('/dashboard/role/{id}', [AdminController::class, 'updateRole'])->whereNumber('id');
    Route::get('/dashboard/role/{entity}', [AdminController::class, 'roleEntity'])->name('dashboard.role.entity.home');
    Route::post('/dashboard/role/{entity}', [AdminController::class, 'addRoleEntity']);
    Route::get('/dashboard/role/{entity}/{id}', [AdminController::class, 'roleEntityDatas'])->whereNumber('id')->name('dashboard.role.entity.datas');
    Route::post('/dashboard/role/{entity}/{id}', [AdminController::class, 'updateRoleEntity'])->whereNumber('id');
    // Sectors
    Route::get('/dashboard/sector', [AdminController::class, 'sector'])->name('dashboard.sector.home');
    Route::post('/dashboard/sector', [AdminController::class, 'addSector']);
    Route::get('/dashboard/sector/{id}', [AdminController::class, 'sectorDatas'])->whereNumber('id')->name('dashboard.sector.datas');
    Route::post('/dashboard/sector/{id}', [AdminController::class, 'updateSector'])->whereNumber('id');
    // Categories
    Route::get('/dashboard/category', [AdminController::class, 'category'])->name('dashboard.category.home');
    Route::post('/dashboard/category', [AdminController::class, 'addCategory']);
    Route::get('/dashboard/category/{id}', [AdminController::class, 'categoryDatas'])->whereNumber('id')->name('dashboard.category.datas');
    Route::post('/dashboard/category/{id}', [AdminController::class, 'updateCategory'])->whereNumber('id');
    Route::get('/dashboard/category/{entity}', [AdminController::class, 'categoryEntity'])->name('dashboard.category.entity.home');
    Route::post('/dashboard/category/{entity}', [AdminController::class, 'addCategoryEntity']);
    Route::get('/dashboard/category/{entity}/{id}', [AdminController::class, 'categoryEntityDatas'])->whereNumber('id')->name('dashboard.category.entity.datas');
    Route::post('/dashboard/category/{entity}/{id}', [AdminController::class, 'updateCategoryEntity'])->whereNumber('id');
    // News
    Route::get('/dashboard/news', [AdminController::class, 'news'])->name('dashboard.news.home');
    Route::post('/dashboard/news', [AdminController::class, 'addNews']);
    Route::get('/dashboard/news/{id}', [AdminController::class, 'newsDatas'])->whereNumber('id')->name('dashboard.news.datas');
    Route::post('/dashboard/news/{id}', [AdminController::class, 'updateNews'])->whereNumber('id');
    // Complaints
    Route::get('/dashboard/complaints', [AdminController::class, 'complaints'])->name('dashboard.complaints.home');
    Route::post('/dashboard/complaints', [AdminController::class, 'answerComplaints']);
    Route::get('/dashboard/complaints/{id}', [AdminController::class, 'complaintsDatas'])->whereNumber('id')->name('dashboard.complaints.datas');
    Route::post('/dashboard/complaints/{id}', [AdminController::class, 'updateComplaintsAnswer'])->whereNumber('id');
    // Account
    Route::get('/account', [PublicController::class, 'account'])->name('account.home');
    Route::post('/account', [PublicController::class, 'updateAccount']);
    Route::get('/account/{entity}', [PublicController::class, 'accountEntity'])->name('account.entity');
    Route::get('/account/{entity}/{id}', [PublicController::class, 'accountDatas'])->whereNumber('id')->name('account.entity.datas');
    Route::post('/account/{entity}/{id}', [PublicController::class, 'updateAccountEntity'])->whereNumber('id');
});

require __DIR__ . '/auth.php';
