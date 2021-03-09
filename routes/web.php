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
Route::group(['middleware' => ['web','auth','user']], function () {
    Route::get('/dashboard', [defaultController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [defaultController::class, 'profile'])->name('my-profile');
    Route::put('/profile-update/{user_id}', [defaultController::class, 'update_profile'])->name('update_profile');
    Route::put('/user/credentials-update/{user_id}', [defaultController::class, 'update_credentials'])->name('update_credentials');

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
    Route::get('/view/added/faq', [FAQController::class, 'view_added_faq'])->name('view_added_faq');
    Route::get('/view/faq', [FAQController::class, 'view_user_faq'])->name('view_user_faq');
    Route::get('/load/faq/{filter}', [FAQController::class, 'load_faq_data'])->name('load_faq_data');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
