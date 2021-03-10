<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SharedFolder\defaultController;
use App\Http\Controllers\Municipal\MunicipalController;
use App\Http\Controllers\Users\UserController;
use \App\Http\Controllers\GuestController;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\Licence\BusinessLicenceController;
use \App\Http\Controllers\Licence\PRNRequestController;
use \App\Http\Controllers\Payments\PaymentController;
use \App\Http\Controllers\Business\BusinessController;
use \App\Http\Controllers\FAQ\FAQController;
use \App\Http\Controllers\LogsController;

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

Route::get("/", function () {
    return redirect()->route('auth_login');
});

//All Middleware Routes
Route::get('/auth/refresh-token', [GuestController::class, 'refreshToken'])->name('refresh_token');

Route::group(['middleware' => ['guest']], function () {
    // Authentication Routes...
    Route::get('/auth/login', [GuestController::class, 'auth_login'])->name('auth_login');
    Route::get('/auth/register', [GuestController::class, 'register_page'])->name('auth_register');
    Route::post('/auth/create/account', [GuestController::class, 'create_account'])->name('create_account');
    Route::get('/auth/password-reset', [GuestController::class, 'password_reset'])->name('auth_password_reset');
    Route::post('/auth/secure/login', [LoginController::class, 'login'])->name('login');
});

// Authenticated User Routes...
Route::group(['middleware' => ['web','auth','admin']], function () {
    Route::get('/dashboard', [defaultController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [defaultController::class, 'profile'])->name('my-profile');
    Route::put('/profile-update/{user_id}', [defaultController::class, 'update_profile'])->name('update_profile');
    Route::put('/user/credentials-update/{user_id}', [defaultController::class, 'update_credentials'])->name('update_credentials');

    //Logs
    Route::get('/system-logs', [LogsController::class, 'logs_list'])->name('logs-list');

    //Users Manage Routes
    Route::get('/add-users', [UserController::class, 'add_users'])->name('add-users');
    Route::get('/view-users', [UserController::class, 'view_users'])->name('view-users');
    Route::post('/save-new-user', [UserController::class, 'save_user'])->name('save-new-user');
    Route::put('/user/update-details/{user_id}', [UserController::class, 'update_user_details'])->name('update_user_details');
    Route::put('/user/password/reset/{user_id}', [UserController::class, 'user_password_reset'])->name('user_password_reset');
    Route::delete('/user/remove/{user_id}', [UserController::class, 'remove_user'])->name('remove_user');

    //Manage User Access
    Route::get('/user/access/{user_id}/control', [UserController::class, 'user_access'])->name('user_access');
    Route::put('/update/user/access/{user_id}', [UserController::class, 'update_access'])->name('update-user-access');

    //Manage Municipals
    Route::get('/add-municipal', [MunicipalController::class, 'add_municipals'])->name('add-municipals');
    Route::get('/view-municipals', [MunicipalController::class, 'view_municipals'])->name('view-municipals');
    Route::post('/save-municipal', [MunicipalController::class, 'save_municipal'])->name('save-new-municipal');
    Route::put('/update-municipal/{municipal_id}', [MunicipalController::class, 'update_municipal_details'])->name('update_municipal_details');
    Route::delete('/remove-municipal/{municipal_id}', [MunicipalController::class, 'remove_municipal'])->name('remove_municipal');

    //Manage Licence
    Route::get('/register-licence', [BusinessLicenceController::class, 'renew_licence'])->name('renew-licence');
    Route::get('/request/levy-channel/{levy_id}', [BusinessLicenceController::class, 'get_levy_channel'])->name('get_levy_channel');
    Route::post('/renew-licence/request', [BusinessLicenceController::class, 'request_business_licence'])->name('request_business_licence');

    //Manage PRN
    Route::get('/request-prn', [PRNRequestController::class, 'request_prn'])->name('request_prn');
    Route::post('/request-prn/server', [PRNRequestController::class, 'business_request_prn'])->name('business_request_prn');

    //View Business
    Route::get('/business-list', [BusinessController::class, 'view_business'])->name('view-business');
    Route::get('/business/details/{id}', [BusinessController::class, 'view_single_business'])->name('view_single_business');

    //Payment's
    Route::get('/payments', [PaymentController::class, 'payments_information'])->name('payments_info');
    Route::get('/payments/history/graph', [PaymentController::class, 'load_payment_graph_data'])->name('load_payment_graph_data');

    //FAQ Routes
    Route::get('/add/faq', [FAQController::class, 'add_new_faq'])->name('add_new_faq');
    Route::get('/view/added/faq', [FAQController::class, 'view_added_faq'])->name('view_added_faq');
    Route::get('/view/faq', [FAQController::class, 'view_user_faq'])->name('view_user_faq');
    Route::get('/load/faq/{filter}', [FAQController::class, 'load_faq_data'])->name('load_faq_data');
    Route::post('/save/new/faq', [FAQController::class, 'save_new_faq'])->name('save-new-faq');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});



