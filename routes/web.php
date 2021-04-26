<?php

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

    //Manage PRN
    Route::get('/request-prn', [PRNRequestController::class, 'request_prn'])->name('request_prn');
    Route::post('/request-prn/server', [PRNRequestController::class, 'business_request_prn'])->name('business_request_prn');

    //View Business
    Route::get('/business-list', [BusinessController::class, 'view_business'])->name('view-business');
    Route::get('/business/details/{id}', [BusinessController::class, 'view_single_business'])->name('view_single_business');

    //Payment's
    Route::get('/payments', [PaymentController::class, 'payments_information'])->name('payments_info');
    Route::get('/payments/history/graph', [PaymentController::class, 'load_payment_graph_data'])->name('load_payment_graph_data');
    Route::get('/download/invoice/{invoiceID}', [PaymentController::class, 'download_invoice'])->name('download_invoice');

    // Customer Support
    Route::get('/contact/support', [CustomerSupportController::class, 'contact_support'])->name('contact_support');
    Route::post('/send/message/support', [CustomerSupportController::class, 'send_message_support'])->name('send_message_support');
    Route::get('/live/support', [CustomerSupportController::class, 'live_support'])->name('live_support');

    //FAQ Routes
    Route::get('/view/added/faq', [FAQController::class, 'view_added_faq'])->name('view_added_faq');
    Route::get('/view/faq', [FAQController::class, 'view_user_faq'])->name('view_user_faq');
    Route::get('/load/faq/{filter}', [FAQController::class, 'load_faq_data'])->name('load_faq_data');
    Route::get('sitemap',[GuestController::class, 'sitemap'])->name('sitemap');
    Route::post('pay/licence',[PaymentController::class,'payBusinessLicence'])->name('pay/licence');

    //Station Management
    Route::get('view_stations',[StationController::class,'index'])->name('view_stations');

    Route::get('create_station',[StationController::class,'create'])->name('create_station');

    Route::post('create_station',[StationController::class,'store'])->name('store_station');

    Route::get('view_station/{id}',[StationController::class,'edit'])->name('edit_station');

    Route::put('update_station',[StationController::class,'update'])->name('update_station');

    Route::get('delete_station/{id}',[StationController::class,'destroy'])->name('destroy_station');

    //Role Management
    Route::get('view_roles/{id}',[RoleController::class,'edit'])->name('view_roles');

    Route::get('view_roles',[RoleController::class,'index'])->name('view_roles');

    Route::get('delete_role/{id}',[RoleController::class,'destroy'])->name('delete_role');;

    Route::put('update_role/{id}',[RoleController::class,'update'])->name('update_role');

    Route::get('create_role',[RoleController::class,'create'])->name('create_role');

    Route::post('create_role',[RoleController::class,'store'])->name('store_role');

    //Incident Management
    Route::get('view_incidents/{id}',[\App\Http\Controllers\IncidentsController::class,'edit'])->name('view_incidents');

    Route::get('view_incidents',[\App\Http\Controllers\IncidentsController::class,'index'])->name('view_incidents'); 

    Route::get('delete_incident/{id}',[\App\Http\Controllers\IncidentsController::class,'destroy'])->name('delete_incident');;
    
    Route::put('update_incident/{id}',[\App\Http\Controllers\IncidentsController::class,'update'])->name('update_incident');
    
    Route::get('create_incident',[\App\Http\Controllers\IncidentsController::class,'index'])->name('create_incident');
    
    Route::post('create_incident',[\App\Http\Controllers\IncidentsController::class,'store'])->name('store_incident');
    
    Route::post('close',[\App\Http\Controllers\IncidentsController::class,'close'])->name('close');
    
    Route::post('cancel',[\App\Http\Controllers\IncidentsController::class,'cancel'])->name('cancel');

    Route::get('reports',[\App\Http\Controllers\IncidentsController::class,'report'])->name('reports');
    Route::post('reports_filtered',[\App\Http\Controllers\IncidentsController::class,'reportfiltered'])->name('reports_filtered');

});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});








