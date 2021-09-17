<?php

use App\Http\Controllers\IncidentsController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SharedFolder\defaultController;
use \App\Http\Controllers\GuestController;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\Licence\BusinessLicenceController;
use \App\Http\Controllers\Licence\PRNRequestController;
use \App\Http\Controllers\Payments\PaymentController;
use \App\Http\Controllers\Business\BusinessController;
use \App\Http\Controllers\Support\CustomerSupportController;
use \App\Http\Controllers\FAQ\FAQController;
use \App\Http\Controllers\RoleController;
use \App\Http\Controllers\StationController;
use \App\Http\Controllers\CompaniesController;
use \App\Http\Controllers\VendorsController;
use \App\Http\Controllers\AssetsController;
use \App\Http\Controllers\StationsController;
use \App\Http\Controllers\InventoryController;
use \App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * Authentication page
 */
Route::get("/", function () {
    return redirect()->route('auth_login');
});

/*
* manage token refresh
*/
Route::get('/auth/refresh-token', [GuestController::class, 'refreshToken'])->name('refresh_token');

 /*
  * manage authentication
  */
Route::group(['middleware' => ['guest']], function () {
    // Authentication Routes...
    Route::get('/auth/login', [GuestController::class, 'auth_login'])->name('auth_login');
    Route::get('/auth/register', [GuestController::class, 'register_page'])->name('auth_register');
    Route::post('/auth/create/account', [GuestController::class, 'create_account'])->name('create_account');
    Route::get('/auth/password-reset', [GuestController::class, 'password_reset'])->name('auth_password_reset');
    Route::post('/auth/login', [GuestController::class, 'login'])->name('login');
});

// Authenticated User Routes...['web', 'auth', 'user']
Route::group(['middleware' => ['web']], function () {
    /*
  * manage dashboard
  */
    Route::get('/dashboard', [defaultController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [defaultController::class, 'profile'])->name('my-profile');

    /*
   * manage users
   */
    Route::put('/profile-update/{user_id}', [defaultController::class, 'update_profile'])->name('update_profile');
    Route::put('/user/credentials-update/{user_id}', [defaultController::class, 'update_credentials'])->name('update_credentials');
    Route::get('/add-users', [UserController::class, 'add_users'])->name('add-users');
    Route::get('/view-users', [UserController::class, 'view_users'])->name('view-users');
    Route::post('/save-new-user', [UserController::class, 'save_user'])->name('save-new-user');
    Route::put('/user/update-details/{user_id}', [UserController::class, 'update_user_details'])->name('update_user_details');
    Route::put('/user/password/reset/{user_id}', [UserController::class, 'user_password_reset'])->name('user_password_reset');
    Route::delete('/user/remove/{user_id}', [UserController::class, 'remove_user'])->name('remove_user');
    Route::get('/user/access/{user_id}/control', [UserController::class, 'user_access'])->name('user_access');
    Route::put('/update/user/access/{user_id}', [UserController::class, 'update_access'])->name('update-user-access');


    /**
     * manage companies
     */

    Route::get('/companies', [CompaniesController::class, 'view_companies'])->name('view_companies');
    Route::post('/company/add', [CompaniesController::class, 'save_company'])->name('save_company');


    /**
     * manage vendors
     */
    Route::get('/vendors', [VendorsController::class, 'view'])->name('view_vendors');
    Route::get('/vendors/create', [VendorsController::class, 'create'])->name('create_vendor');
    Route::post('/vendors/save', [VendorsController::class, 'save'])->name('save_vendor');
    Route::get('/vendors/edit/{vendor_id}', [VendorsController::class, 'edit'])->name('edit_vendor');
    Route::post('/vendors/update', [VendorsController::class, 'update'])->name('update_vendor');
    Route::post('/vendors/delete', [VendorsController::class, 'delete'])->name('delete_vendor');

    /*
     * manage assets
     */
    Route::get('/assets', [AssetsController::class, 'view'])->name('view_assets');
    Route::get('/assets/create', [AssetsController::class, 'create'])->name('create_asset');
    Route::post('/assets/save', [AssetsController::class, 'save'])->name('save_asset');
    Route::get('/assets/edit/{asset_id}', [AssetsController::class, 'edit'])->name('edit_asset');
    Route::post('/assets/update', [AssetsController::class, 'update'])->name('update_asset');
    Route::post('/assets/delete', [AssetsController::class, 'delete'])->name('delete_asset');

    /*
    * manage companies
    */
    Route::get('/companies', [CompaniesController::class, 'view'])->name('view_companies');
    Route::get('/companies/create', [CompaniesController::class, 'create'])->name('create_company');
    Route::post('/companies/save', [CompaniesController::class, 'save'])->name('save_company');
    Route::get('/companies/edit/{company_id}', [CompaniesController::class, 'edit'])->name('edit_company');
    Route::post('/companies/update', [CompaniesController::class, 'update'])->name('update_company');
    Route::post('/companies/delete', [CompaniesController::class, 'delete'])->name('delete_company');

    /*
   * manage stations
   */
    Route::get('/stations', [StationsController::class, 'view'])->name('view_stations');
    Route::get('/stations/create', [StationsController::class, 'create'])->name('create_station');
    Route::post('/stations/save', [StationsController::class, 'save'])->name('save_station');
    Route::get('/stations/edit/{company_id}', [StationsController::class, 'edit'])->name('edit_station');
    Route::post('/stations/update', [StationsController::class, 'update'])->name('update_station');
    Route::post('/stations/delete', [StationsController::class, 'delete'])->name('delete_station');

    /*
   * manage inventories
   */
    Route::get('/inventory', [InventoryController::class, 'view'])->name('view_allocations');
    Route::get('/inventory/allocate', [InventoryController::class, 'allocate_view'])->name('allocate_assets');
    Route::post('/inventory/allocate', [InventoryController::class, 'allocate'])->name('allocate_asset');
    Route::post('/inventory/disallocate', [InventoryController::class, 'disallocate'])->name('disallocate_asset');
    Route::post('/inventory/delete', [InventoryController::class, 'delete'])->name('delete_allocation');

    /*
   * manage categories
   */
    Route::get('/categories', [CategoriesController::class, 'view'])->name('view_categories');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('create_category');
    Route::post('/categories/save', [CategoriesController::class, 'save'])->name('save_category');
    Route::get('/categories/edit/{category_id}', [CategoriesController::class, 'edit'])->name('edit_category');
    Route::post('/categories/update', [CategoriesController::class, 'update'])->name('update_category');
    Route::post('/categories/delete', [CategoriesController::class, 'delete'])->name('delete_category');


    /*
   * manage assets
   */
    Route::get('view_roles/{id}', [RoleController::class, 'edit'])->name('view_roles');
    Route::get('view_roles', [RoleController::class, 'index'])->name('view_roles');
    Route::get('delete_role/{id}', [RoleController::class, 'destroy'])->name('delete_role');;
    Route::put('update_role/{id}', [RoleController::class, 'update'])->name('update_role');
    Route::get('create_role', [RoleController::class, 'create'])->name('create_role');
    Route::post('create_role', [RoleController::class, 'store'])->name('store_role');

    /*
   * manage incidents
   */
    Route::get('view_incidents/{id}', [IncidentsController::class, 'edit'])->name('view_incidents');
    Route::get('view_incidents', [IncidentsController::class, 'index'])->name('view_incidents');
    Route::get('delete_incident/{id}', [IncidentsController::class, 'destroy'])->name('delete_incident');;
    Route::put('update_incident/{id}', [IncidentsController::class, 'update'])->name('update_incident');
    Route::get('create_incident', [IncidentsController::class, 'index'])->name('create_incident');
    Route::post('create_incident', [IncidentsController::class, 'store'])->name('store_incident');
    Route::post('close', [IncidentsController::class, 'close'])->name('close');
    Route::post('cancel', [IncidentsController::class, 'cancel'])->name('cancel');
    Route::get('reports', [IncidentsController::class, 'report'])->name('reports');
    Route::post('reports_filtered', [IncidentsController::class, 'reportfiltered'])->name('reports_filtered');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
