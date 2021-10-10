<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Permit\PermitApiController;
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
//TODO: Add middleware once project is completed
Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [ApiController::class, 'login'])->name('login');
    Route::post('change_password', [ApiController::class, 'changePassword'])->name('change_password');
    Route::post('register', [ApiController::class, 'registration'])->name('registration');
    Route::post('incidents',[ApiController::class,'incidents'])->name('incidents');
    Route::post('retrieve/incident',[ApiController::class,'retrieveIncident'])->name('retrieve/incident');
    Route::post('incidents/per_caller',[ApiController::class,'incidentsByCreatedById'])->name('incidents/per_caller');
    Route::post('incidents/dashboard',[ApiController::class,'incidentsDashboard'])->name('incidents/dashboard');
    Route::post('incidents/per_company',[ApiController::class,'incidentsByCompanyId'])->name('incidents/per_company');
    Route::post('incidents/per_assigned',[ApiController::class,'incidentsByAssignedById'])->name('incidents/per_assigned');
    Route::get('priorities',[ApiController::class,'priorities'])->name('priorities');
    Route::get('users',[ApiController::class,'users'])->name('users');
    Route::post('add/incident',[ApiController::class,'storeIncident'])->name('add/incident');
    Route::get('system_data',[ApiController::class,'systemData'])->name('system_data');
    Route::get('report/{id}',[ApiController::class,'appReport'])->name('report');
    Route::get('stations',[ApiController::class,'stations'])->name('stations');
    Route::post('close/incident',[ApiController::class,'closeIncident'])->name('closeIncident');
    Route::get('send/sms',[ApiController::class,'sendSms'])->name('sendSms');
    Route::get('sms',[ApiController::class,'multipleSms'])->name('sms');
    Route::post('create/job_assessment',[PermitApiController::class,'store']);
    Route::get('view/job_assessment',[PermitApiController::class,'retrieve']);
    Route::get('incidents/status/update',[ApiController::class,'process']);

    //Incident Process Links
    Route::post('close/incident',[ApiController::class,'closeIncident']);
    Route::post('assign/incident',[ApiController::class,'assignIncident']);
    Route::post('request/incident/permission',[ApiController::class,'requestIncidentPermit']);
    Route::post('approve/incident',[ApiController::class,'approveIncident']);
    Route::post('cancel/incident',[ApiController::class,'cancelIncident']);
});





