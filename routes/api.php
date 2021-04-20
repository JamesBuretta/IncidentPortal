<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GuestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [ApiController::class, 'login'])->name('login');
    Route::post('register', [ApiController::class, 'register'])->name('register');
    Route::get('incidents',[ApiController::class,'incidents'])->name('incidents');
    Route::get('priorities',[ApiController::class,'priorities'])->name('priorities');
    Route::get('users',[ApiController::class,'users'])->name('users');
    Route::post('add/incident',[ApiController::class,'storeIncident'])->name('add/incident');
    Route::get('system_data',[ApiController::class,'systemData'])->name('system_data');
});





