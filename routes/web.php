<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\GuestController;
use \App\Http\Controllers\Auth\LoginController;

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

Route::group(['middleware' => ['guest']], function () {
    // Authentication Routes...
    Route::get('/auth/login', [GuestController::class, 'auth_login'])->name('auth_login');
    Route::get('/auth/refresh-token', [GuestController::class, 'refreshToken'])->name('refresh_token');
    Route::get('/auth/register', [GuestController::class, 'register_page'])->name('auth_register');
    Route::get('/auth/password-reset', [GuestController::class, 'password_reset'])->name('auth_password_reset');
    Route::post('/auth/secure/login', [LoginController::class, 'login'])->name('login');
});

// Authenticated User Routes...
Route::group(['middleware' => ['admin']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('my-profile');

    //Users Manage Routes
    Route::get('/add-users', [UserController::class, 'add_users'])->name('add-users');
    Route::get('/view-users', [UserController::class, 'view_users'])->name('view-users');
    Route::post('/save-new-user', [UserController::class, 'save_user'])->name('save-new-user');
    Route::put('/user/update-details/{user_id}', [UserController::class, 'update_user_details'])->name('update_user_details');
    Route::put('/user/password/reset/{user_id}', [UserController::class, 'user_password_reset'])->name('user_password_reset');
    Route::delete('/user/remove/{user_id}', [UserController::class, 'remove_user'])->name('remove_user');

    Route::delete('/users/remove/{user_id}',[
        'uses' => 'AdminController@delete_user' , 'as' => 'delete_user'
    ]);
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
